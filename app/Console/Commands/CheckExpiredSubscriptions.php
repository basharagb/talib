<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired subscriptions and send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking expired subscriptions...');

        // Find subscriptions expiring in 30 days
        $expiringSoon = Subscription::where('status', 'active')
            ->whereDate('expires_at', '=', Carbon::now()->addDays(30))
            ->with('user')
            ->get();

        foreach ($expiringSoon as $subscription) {
            $this->sendExpirationWarning($subscription);
            $this->info("Warning sent to user: {$subscription->user->email}");
        }

        // Find expired subscriptions
        $expired = Subscription::where('status', 'active')
            ->whereDate('expires_at', '<', Carbon::now())
            ->with('user')
            ->get();

        foreach ($expired as $subscription) {
            $subscription->update(['status' => 'expired']);
            $this->sendExpirationNotice($subscription);
            $this->info("Subscription expired for user: {$subscription->user->email}");
        }

        $this->info("Processed {$expiringSoon->count()} expiring and {$expired->count()} expired subscriptions.");
    }

    private function sendExpirationWarning($subscription)
    {
        // Here you would send an email notification
        // For now, we'll just log it
        Log::info("Subscription expiring in 30 days for user: {$subscription->user->email}");
    }

    private function sendExpirationNotice($subscription)
    {
        // Here you would send an email notification
        // For now, we'll just log it
        Log::info("Subscription expired for user: {$subscription->user->email}");
    }
}
