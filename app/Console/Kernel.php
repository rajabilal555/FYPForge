<?php

namespace App\Console;

use App\Models\ProjectAdvisorInvite;
use App\Models\ProjectMemberInvite;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // TODO: move to a job, which will also send notifications to each users.
            // Clear the expired project invites
            ProjectMemberInvite::where('expires_at', '<=', now())->update(['status' => 'expired']);
            ProjectAdvisorInvite::where('expires_at', '<=', now())->update(['status' => 'expired']);
        })->twiceDaily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
