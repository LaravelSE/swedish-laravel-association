<?php

namespace App\Console\Commands;

use App\Mail\AnnualMeetingInvitation;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;
use Throwable;

class SendAnnualMeetingInvitations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'members:send-annual-meeting-invitation
        {--dry-run : List recipients without sending anything}
        {--skip=0 : Skip the first N members (name order) who already received the invitation}';

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

        $skip = max(0, (int) $this->option('skip'));

        if ($skip > 0) {
            $this->comment("Skipping the first {$skip} of {$members->count()} member(s) (name order).");
            $members = $members->slice($skip)->values();
        }

        if ($members->isEmpty()) {
            $this->warn('Every member is skipped — nothing to send.');

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

        $failures = [];

        $this->withProgressBar($members, function (User $member) use (&$failures): void {
            try {
                Mail::to($member)->send(new AnnualMeetingInvitation($member));
            } catch (Throwable $exception) {
                $failures[] = [$member->name, $member->email, $exception->getMessage()];
            }

            Sleep::for(1)->second();
        });

        $this->newLine(2);

        $sent = $members->count() - count($failures);
        $this->info("Kallelse sent to {$sent} of {$members->count()} member(s).");

        if ($failures !== []) {
            $this->error(count($failures).' send(s) failed:');
            $this->table(['Name', 'Email', 'Error'], $failures);

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
