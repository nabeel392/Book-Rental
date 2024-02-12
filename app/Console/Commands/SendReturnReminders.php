<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rental;
use Carbon\Carbon;
use App\Notifications\ReturnBookReminder;

class SendReturnReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-return-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send return book reminders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::today();
        $rentalsDue = Rental::whereDate('return_date', '=', $currentDate)->get();

        foreach ($rentalsDue as $rental) {
            $user = $rental->user;

            // Get the return date from the rental
            $returnDate = Carbon::parse($rental->return_date);

            // Create and send the notification with the Book and return date
            $user->notify(new ReturnBookReminder($rental->book, $returnDate));
        }

        $this->info('Return reminders sent successfully.');
    }
}
