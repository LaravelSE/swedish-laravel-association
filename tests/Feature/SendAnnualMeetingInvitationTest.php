<?php

use App\Mail\AnnualMeetingInvitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;

uses(RefreshDatabase::class);

beforeEach(function () {
    Sleep::fake();
});

test('it lists recipients without sending anything when --dry-run is passed', function () {
    Mail::fake();

    User::factory()->count(2)->create();

    $this->artisan('members:send-annual-meeting-invitation', ['--dry-run' => true])
        ->assertSuccessful();

    Mail::assertNothingSent();
});

test('it warns and exits cleanly when there are no registered users', function () {
    Mail::fake();

    $this->artisan('members:send-annual-meeting-invitation', ['--dry-run' => true])
        ->expectsOutputToContain('No registered users found')
        ->assertSuccessful();

    Mail::assertNothingSent();
});

test('it sends the kallelse to every registered member after confirmation', function () {
    Mail::fake();

    $members = User::factory()->count(3)->create();

    $this->artisan('members:send-annual-meeting-invitation')
        ->expectsConfirmation('Send the kallelse to all 3 registered member(s) now?', 'yes')
        ->assertSuccessful();

    Mail::assertSent(AnnualMeetingInvitation::class, 3);

    $members->each(function (User $member) {
        Mail::assertSent(
            AnnualMeetingInvitation::class,
            fn (AnnualMeetingInvitation $mail): bool => $mail->hasTo($member->email),
        );
    });
});

test('it skips the first N members in name order when --skip is passed', function () {
    Mail::fake();

    $anna = User::factory()->create(['name' => 'Anna']);
    $bertil = User::factory()->create(['name' => 'Bertil']);
    $cecilia = User::factory()->create(['name' => 'Cecilia']);

    $this->artisan('members:send-annual-meeting-invitation', ['--skip' => 2])
        ->expectsConfirmation('Send the kallelse to all 1 registered member(s) now?', 'yes')
        ->assertSuccessful();

    Mail::assertSent(AnnualMeetingInvitation::class, 1);
    Mail::assertSent(
        AnnualMeetingInvitation::class,
        fn (AnnualMeetingInvitation $mail): bool => $mail->hasTo($cecilia->email),
    );
});

test('it dry-runs the remaining recipients when --skip is combined with --dry-run', function () {
    Mail::fake();

    User::factory()->create(['name' => 'Anna']);
    $bertil = User::factory()->create(['name' => 'Bertil']);

    $this->artisan('members:send-annual-meeting-invitation', ['--dry-run' => true, '--skip' => 1])
        ->expectsOutputToContain('Skipping the first 1 of 2 member(s)')
        ->expectsOutputToContain($bertil->email)
        ->expectsOutputToContain('1 member(s) would receive the invitation.')
        ->assertSuccessful();

    Mail::assertNothingSent();
});

test('it exits cleanly when --skip covers every member', function () {
    Mail::fake();

    User::factory()->count(2)->create();

    $this->artisan('members:send-annual-meeting-invitation', ['--skip' => 2])
        ->expectsOutputToContain('Every member is skipped — nothing to send.')
        ->assertSuccessful();

    Mail::assertNothingSent();
});

test('it continues past a failed send and reports the failure at the end', function () {
    $anna = User::factory()->create(['name' => 'Anna', 'email' => 'anna@example.com']);
    $bertil = User::factory()->create(['name' => 'Bertil', 'email' => 'bertil@example.com']);

    Mail::shouldReceive('to')->twice()->andReturnUsing(function (User $member) {
        $mock = Mockery::mock();

        if ($member->email === 'anna@example.com') {
            $mock->shouldReceive('send')->once()->andThrow(new RuntimeException('API Key is not enabled (code 401).'));
        } else {
            $mock->shouldReceive('send')->once();
        }

        return $mock;
    });

    $this->artisan('members:send-annual-meeting-invitation')
        ->expectsConfirmation('Send the kallelse to all 2 registered member(s) now?', 'yes')
        ->expectsOutputToContain('Kallelse sent to 1 of 2 member(s).')
        ->expectsOutputToContain('1 send(s) failed:')
        ->expectsOutputToContain('anna@example.com')
        ->assertFailed();
});

test('it sends nothing when the confirmation prompt is declined', function () {
    Mail::fake();

    User::factory()->count(2)->create();

    $this->artisan('members:send-annual-meeting-invitation')
        ->expectsConfirmation('Send the kallelse to all 2 registered member(s) now?', 'no')
        ->assertSuccessful();

    Mail::assertNothingSent();
});
