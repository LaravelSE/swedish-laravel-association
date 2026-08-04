<?php

use App\Mail\AnnualMeetingInvitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

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
        ->expectsConfirmation("Send the kallelse to all 3 registered member(s) now?", 'yes')
        ->assertSuccessful();

    Mail::assertSent(AnnualMeetingInvitation::class, 3);

    $members->each(function (User $member) {
        Mail::assertSent(
            AnnualMeetingInvitation::class,
            fn (AnnualMeetingInvitation $mail): bool => $mail->hasTo($member->email),
        );
    });
});

test('it sends nothing when the confirmation prompt is declined', function () {
    Mail::fake();

    User::factory()->count(2)->create();

    $this->artisan('members:send-annual-meeting-invitation')
        ->expectsConfirmation('Send the kallelse to all 2 registered member(s) now?', 'no')
        ->assertSuccessful();

    Mail::assertNothingSent();
});
