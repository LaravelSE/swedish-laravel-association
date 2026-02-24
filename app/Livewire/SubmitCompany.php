<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubmitCompany extends Component
{
    use WithFileUploads;

    // User registration fields (only used if not logged in)
    public string $name = '';

    public string $email = '';

    public string $userPhone = '';

    public string $password = '';

    public string $password_confirmation = '';

    // Company details
    public string $companyName = '';

    public string $city = '';

    public string $website = '';

    public string $industry = '';

    public string $size = '';

    public string $description = '';

    // Contact info
    public string $contactEmail = '';

    public string $phone = '';

    public string $address = '';

    // Logo & social
    public $logo;

    public string $linkedin = '';

    public string $github = '';

    public string $twitter = '';

    // Relationship
    public string $submitterRelationship = '';

    public string $notes = '';

    public bool $submitted = false;

    protected function rules(): array
    {
        $rules = [
            'companyName' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:255',
            'size' => 'nullable|in:'.implode(',', Company::SIZES),
            'description' => 'nullable|string|max:2000',
            'contactEmail' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'submitterRelationship' => 'required|in:'.implode(',', Company::SUBMITTER_RELATIONSHIPS),
            'notes' => 'nullable|string|max:2000',
        ];

        if (! Auth::check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|string|lowercase|email|max:255|unique:'.User::class;
            $rules['userPhone'] = 'nullable|string|max:20';
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }

        return $rules;
    }

    /** @var array<string, string> */
    protected $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered. Please log in instead.',
        'password.required' => 'Please enter a password.',
        'password.confirmed' => 'The password confirmation does not match.',
        'companyName.required' => 'Please enter the company name.',
        'city.required' => 'Please enter the city.',
        'submitterRelationship.required' => 'Please select how you know about this company.',
        'submitterRelationship.in' => 'Please select a valid relationship option.',
    ];

    public function submit(): void
    {
        $this->validate();

        $logoPath = null;
        if ($this->logo) {
            $logoPath = $this->logo->store('company-logos', 'public');
            if ($logoPath === false) {
                $this->addError('logo', 'Failed to upload the logo. Please try again.');

                return;
            }
        }

        DB::transaction(function () use ($logoPath) {
            if (! Auth::check()) {
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->userPhone,
                    'password' => Hash::make($this->password),
                ]);

                event(new Registered($user));
                Auth::login($user);
            } else {
                $user = Auth::user();
            }

            Company::create([
                'user_id' => $user->id,
                'name' => $this->companyName,
                'city' => $this->city,
                'website' => $this->website ?: null,
                'industry' => $this->industry ?: null,
                'size' => $this->size ?: null,
                'description' => $this->description ?: null,
                'contact_email' => $this->contactEmail ?: null,
                'phone' => $this->phone ?: null,
                'address' => $this->address ?: null,
                'logo_path' => $logoPath,
                'linkedin' => $this->linkedin ?: null,
                'github' => $this->github ?: null,
                'twitter' => $this->twitter ?: null,
                'submitter_relationship' => $this->submitterRelationship,
            ]);
        });

        $this->submitted = true;
    }

    public function render(): View
    {
        return view('livewire.submit-company', [
            'availableSizes' => Company::SIZES,
            'availableRelationships' => Company::SUBMITTER_RELATIONSHIPS,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
        ])->layout('components.layouts.app', ['title' => 'Submit a Company - Swedish Laravel Association']);
    }
}
