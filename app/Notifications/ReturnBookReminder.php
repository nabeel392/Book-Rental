<?php

namespace App\Notifications;

use App\Models\Book;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReturnBookReminder extends Notification
{
    use Queueable;

    /**
     * The book instance.
     *
     * @var \App\Models\Book
     */
    protected $book;

    /**
     * The return date.
     *
     * @var \Carbon\Carbon
     */


    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Book $book

     */

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Fetch the rentals for the book
        $rentals = $this->book->rentals;

        // Check if any rentals exist and get the latest one
        if ($rentals->isNotEmpty()) {
            // Get the latest rental
            $latestRental = $rentals->last();

            // Check if the return date is set
            if ($latestRental->return_date) {
                // Parse the return date string to a Carbon instance
                $returnDate = Carbon::parse($latestRental->return_date);

                return (new MailMessage)
                            ->line('You have a book due for return!')
                            ->line('Please return the book "' . $this->book->title . '" by ' . $returnDate->format('Y-m-d'));
            }
        }

        // Handle case where rentals or return date is not set
        return (new MailMessage)
                    ->line('There was an issue with the return date for the book "' . $this->book->title . '". Please contact support.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
