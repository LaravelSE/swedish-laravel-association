<?php

namespace App\Livewire;

use App\Models\Talk;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;

class SubmitTalk extends Component
{
    /**
     * Available cities for meetup selection.
     *
     * @var list<string>
     */
    public const CITIES = ['Stockholm', 'Malmö', 'Gothenburg'];

    // User registration fields (only used if not logged in)
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $password = '';

    public string $password_confirmation = '';

    // Talk submission fields
    public string $title = '';

    public string $description = '';

    /** @var array<string> */
    public array $cities = [];

    public string $position = '';

    public string $company = '';

    public string $twitter = '';

    public string $linkedin = '';

    public string $github = '';

    public string $bluesky = '';

    public string $facebook = '';

    public string $instagram = '';

    public string $notes = '';

    public bool $submitted = false;

    protected function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'cities' => 'required|array|min:1',
            'cities.*' => 'in:'.implode(',', self::CITIES),
            'position' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'bluesky' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'notes' => 'nullable|string|max:2000',
        ];

        // Add user registration rules if not logged in
        if (! Auth::check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|string|lowercase|email|max:255|unique:'.User::class;
            $rules['phone'] = 'nullable|string|max:20';
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
        'title.required' => 'Please enter a title for your talk.',
        'description.required' => 'Please provide a description of your talk.',
        'description.min' => 'Please provide a more detailed description (at least 50 characters).',
        'cities.required' => 'Please select at least one city.',
        'cities.min' => 'Please select at least one city.',
        'position.required' => 'Please enter your current position.',
    ];

    public function submit(): void
    {
        $this->validate();

        // If user is not logged in, create account first
        if (! Auth::check()) {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => Hash::make($this->password),
            ]);

            event(new Registered($user));
            Auth::login($user);
        } else {
            $user = Auth::user();
        }

        // Create the talk submission
        Talk::create([
            'user_id' => $user->id,
            'title' => $this->title,
            'description' => $this->description,
            'cities' => $this->cities,
            'position' => $this->position,
            'company' => $this->company ?: null,
            'twitter' => $this->twitter ?: null,
            'linkedin' => $this->linkedin ?: null,
            'github' => $this->github ?: null,
            'bluesky' => $this->bluesky ?: null,
            'facebook' => $this->facebook ?: null,
            'instagram' => $this->instagram ?: null,
            'notes' => $this->notes ?: null,
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.submit-talk', [
            'availableCities' => self::CITIES,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
        ])->layout('components.layouts.app', ['title' => 'Submit a Talk - Swedish Laravel Association']);
    }
}
