<?php

use App\Mail\StockholmMeetupInvitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;

uses(RefreshDatabase::class);

beforeEach(function () {
    Mail::fake();
    Sleep::fake();
});

it('sends the invitation to every member after confirmation', function () {
    $members = User::factory()->count(3)->create();

    $this->artisan('members:send-stockholm-meetup-invitation')
        ->expectsConfirmation('Send the meetup invitation to all 3 registered member(s) now?', 'yes')
        ->assertSuccessful();

    Mail::assertSentCount(3);
    $members->each(fn (User $member) => Mail::assertSent(
        StockholmMeetupInvitation::class,
        fn (StockholmMeetupInvitation $mail): bool => $mail->hasTo($member->email),
    ));
});

it('sends nothing when the confirmation is declined', function () {
    User::factory()->count(2)->create();

    $this->artisan('members:send-stockholm-meetup-invitation')
        ->expectsConfirmation('Send the meetup invitation to all 2 registered member(s) now?', 'no')
        ->assertSuccessful();

    Mail::assertNothingSent();
});

it('lists recipients without sending on a dry run', function () {
    User::factory()->create(['name' => 'Anna Andersson', 'email' => 'anna@example.com']);

    $this->artisan('members:send-stockholm-meetup-invitation --dry-run')
        ->expectsTable(['Name', 'Email'], [['Anna Andersson', 'anna@example.com']])
        ->assertSuccessful();

    Mail::assertNothingSent();
});

it('skips the first members in name order', function () {
    User::factory()->create(['name' => 'Anna', 'email' => 'anna@example.com']);
    User::factory()->create(['name' => 'Bertil', 'email' => 'bertil@example.com']);

    $this->artisan('members:send-stockholm-meetup-invitation --skip=1')
        ->expectsConfirmation('Send the meetup invitation to all 1 registered member(s) now?', 'yes')
        ->assertSuccessful();

    Mail::assertSentCount(1);
    Mail::assertSent(StockholmMeetupInvitation::class, fn (StockholmMeetupInvitation $mail): bool => $mail->hasTo('bertil@example.com'));
});

it('greets the member by first name and includes the event details', function () {
    $member = User::factory()->make(['name' => 'Isak Berglind']);

    $mail = new StockholmMeetupInvitation($member);

    $mail->assertHasSubject('Laravel Meetup i Stockholm på onsdag 30 september');
    $mail->assertSeeInHtml('Hej Isak,', false);
    $mail->assertDontSeeInHtml('Berglind');
    $mail->assertSeeInHtml('Kameo, Tegnérgatan 8, 113 58 Stockholm', false);
    $mail->assertSeeInHtml('https://luma.com/3q813a01');
});

it('keeps the whole name when it is a single word', function () {
    $mail = new StockholmMeetupInvitation(User::factory()->make(['name' => '  Samuel ']));

    $mail->assertSeeInHtml('Hej Samuel,', false);
});
