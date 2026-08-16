<?php

use App\Livewire\Admin\JobList;
use App\Models\Company;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;

uses(RefreshDatabase::class);

test('non-admin users cannot access admin job list', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/jobs')
        ->assertForbidden();
});

test('guests cannot access admin job list', function () {
    $this->get('/admin/jobs')
        ->assertRedirect(route('login'));
});

test('admin can access job list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get('/admin/jobs')
        ->assertSuccessful()
        ->assertSeeLivewire(JobList::class);
});

test('admin can filter jobs by status', function () {
    $admin = User::factory()->admin()->create();
    JobListing::factory()->create(['title' => 'Pending Role']);
    JobListing::factory()->approved()->create(['title' => 'Approved Role']);

    Livewire::actingAs($admin)
        ->test(JobList::class)
        ->set('statusFilter', 'approved')
        ->assertSee('Approved Role')
        ->assertDontSee('Pending Role');
});

test('approving a job marks it approved and posts to slack', function () {
    config()->set('services.slack.notifications.bot_user_oauth_token', 'xoxb-test');
    config()->set('services.slack.notifications.channel', '#jobs');
    Http::fake(['slack.com/*' => Http::response(['ok' => true], 200)]);

    $admin = User::factory()->admin()->create();
    $job = JobListing::factory()->create();

    Livewire::actingAs($admin)
        ->test(JobList::class)
        ->call('approve', $job->id);

    $job->refresh();
    expect($job->status)->toBe('approved');
    expect($job->approved_at)->not->toBeNull();
    expect($job->posted_to_slack_at)->not->toBeNull();

    Http::assertSent(fn ($request) => str_contains($request->url(), 'chat.postMessage'));
});

test('approving still succeeds when slack is not configured', function () {
    config()->set('services.slack.notifications.bot_user_oauth_token', null);
    config()->set('services.slack.notifications.channel', null);

    $admin = User::factory()->admin()->create();
    $job = JobListing::factory()->create();

    Livewire::actingAs($admin)
        ->test(JobList::class)
        ->call('approve', $job->id);

    $job->refresh();
    expect($job->status)->toBe('approved');
    expect($job->posted_to_slack_at)->toBeNull();
});

test('admin can reject a job', function () {
    $admin = User::factory()->admin()->create();
    $job = JobListing::factory()->create();

    Livewire::actingAs($admin)
        ->test(JobList::class)
        ->call('reject', $job->id);

    expect($job->refresh()->status)->toBe('rejected');
});

test('admin can add a job employer to the company listing', function () {
    $admin = User::factory()->admin()->create();
    $job = JobListing::factory()->create([
        'company_name' => 'Acme AB',
        'location' => 'Stockholm, Stockholm County, Sweden',
    ]);

    Livewire::actingAs($admin)
        ->test(JobList::class)
        ->call('addToCompanies', $job->id);

    $company = Company::where('name', 'Acme AB')->first();
    expect($company)->not->toBeNull();
    expect($company->city)->toBe('Stockholm');
    expect($company->status)->toBe('pending');
    expect($company->user_id)->toBe($admin->id);

    expect($job->refresh()->company_id)->toBe($company->id);
});

test('adding the same job to companies twice does not create duplicates', function () {
    $admin = User::factory()->admin()->create();
    $job = JobListing::factory()->create(['company_name' => 'Acme AB']);

    $component = Livewire::actingAs($admin)->test(JobList::class);
    $component->call('addToCompanies', $job->id);
    $component->call('addToCompanies', $job->id);

    expect(Company::where('name', 'Acme AB')->count())->toBe(1);
});

test('approving a job records who reviewed it in the activity log', function () {
    config()->set('services.slack.notifications.bot_user_oauth_token', null);
    config()->set('services.slack.notifications.channel', null);

    $admin = User::factory()->admin()->create();
    $job = JobListing::factory()->create();

    Livewire::actingAs($admin)
        ->test(JobList::class)
        ->call('approve', $job->id);

    $activity = Activity::query()
        ->where('subject_type', JobListing::class)
        ->where('subject_id', $job->id)
        ->latest('id')
        ->first();

    expect($activity)->not->toBeNull();
    expect($activity->causer_id)->toBe($admin->id);
    expect(data_get($activity->attribute_changes, 'attributes.status'))->toBe('approved');

    // Surfaced in the admin list via the accessor.
    expect($job->fresh()->last_reviewer)->toBe($admin->name);
});

test('rejecting a job records who reviewed it in the activity log', function () {
    $admin = User::factory()->admin()->create();
    $job = JobListing::factory()->create();

    Livewire::actingAs($admin)
        ->test(JobList::class)
        ->call('reject', $job->id);

    $activity = Activity::query()
        ->where('subject_type', JobListing::class)
        ->where('subject_id', $job->id)
        ->latest('id')
        ->first();

    expect($activity?->causer_id)->toBe($admin->id);
    expect(data_get($activity->attribute_changes, 'attributes.status'))->toBe('rejected');
});

test('non-admin cannot approve a job via the component', function () {
    $user = User::factory()->create();
    $job = JobListing::factory()->create();

    Livewire::actingAs($user)
        ->test(JobList::class)
        ->call('approve', $job->id)
        ->assertForbidden();

    expect($job->refresh()->status)->toBe('pending');
});

test('approving an already-approved job does not re-post to slack', function () {
    config()->set('services.slack.notifications.bot_user_oauth_token', 'xoxb-test');
    config()->set('services.slack.notifications.channel', '#jobs');
    Http::fake(['slack.com/*' => Http::response(['ok' => true], 200)]);

    $admin = User::factory()->admin()->create();
    $job = JobListing::factory()->approved()->create(['posted_to_slack_at' => now()->subDay()]);

    Livewire::actingAs($admin)
        ->test(JobList::class)
        ->call('approve', $job->id);

    Http::assertNothingSent();
    expect($job->refresh()->status)->toBe('approved');
});
