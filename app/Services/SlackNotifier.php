<?php

namespace App\Services;

use App\Models\JobListing;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Posts messages to Slack using the bot token configured in
 * config/services.php ('slack.notifications').
 */
class SlackNotifier
{
    private const POST_MESSAGE_URL = 'https://slack.com/api/chat.postMessage';

    /**
     * Whether a Slack bot token and target channel are both configured.
     */
    public function isConfigured(): bool
    {
        return ! empty(config('services.slack.notifications.bot_user_oauth_token'))
            && ! empty(config('services.slack.notifications.channel'));
    }

    /**
     * Post an approved job to the default Slack channel.
     * Returns true on success, false if Slack is not configured or the call failed.
     */
    public function postJob(JobListing $job): bool
    {
        if (! $this->isConfigured()) {
            Log::warning('SlackNotifier: missing bot token or channel; skipping post.');

            return false;
        }

        $token = config('services.slack.notifications.bot_user_oauth_token');
        $channel = config('services.slack.notifications.channel');

        $location = $job->location ? "  •  {$job->location}" : '';
        $fallback = "{$job->title} at {$job->company_name}";

        $payload = [
            'channel' => $channel,
            'text' => $fallback, // notification fallback
            'blocks' => [
                [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => "*{$job->title}*\n{$job->company_name}{$location}",
                    ],
                ],
                [
                    'type' => 'actions',
                    'elements' => [
                        [
                            'type' => 'button',
                            'text' => ['type' => 'plain_text', 'text' => 'View job on LinkedIn'],
                            'url' => $job->url,
                        ],
                    ],
                ],
            ],
        ];

        try {
            $response = Http::withToken($token)
                ->timeout(15)
                ->post(self::POST_MESSAGE_URL, $payload);
        } catch (\Throwable $e) {
            Log::warning("SlackNotifier: request failed: {$e->getMessage()}");

            return false;
        }

        if (! $response->successful() || ! ($response->json('ok') === true)) {
            Log::warning('SlackNotifier: Slack API error: '.$response->body());

            return false;
        }

        return true;
    }
}
