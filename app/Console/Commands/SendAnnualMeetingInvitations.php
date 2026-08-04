<?php

namespace App\Console\Commands;

use App\Mail\AnnualMeetingInvitation;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAnnualMeetingInvitations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'members:send-annual-meeting-invitation {--dry-run : List recipients without sending anything}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the kallelse (annual meeting invitation) to all registered members';

    public function handle(): int
    {
        $members = User::query()->orderBy('name')->get();

        if ($members->isEmpty()) {
            $this->warn('No registered users found — nothing to send.');

            return self::SUCCESS;
        }

        if ($this->option('dry-run')) {
            $this->table(
                ['Name', 'Email'],
                $members->map(fn (User $member): array => [$member->name, $member->email])->all(),
            );
            $this->info("{$members->count()} member(s) would receive the invitation.");

            return self::SUCCESS;
        }

        if (! $this->confirm("Send the kallelse to all {$members->count()} registered member(s) now?", false)) {
            $this->comment('Cancelled — no emails were sent.');

            return self::SUCCESS;
        }

        $this->withProgressBar($members, function (User $member): void {
            Mail::to($member)->send(new AnnualMeetingInvitation($member));
        });

        $this->newLine(2);
        $this->info("Kallelse sent to {$members->count()} member(s).");

        return self::SUCCESS;
    }
}
