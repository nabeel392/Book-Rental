<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rental;
use App\Notifications\ReturnBookReminder;

class BookController extends Controller
{
    public function rent(Request $request, Book $book)
{

    $userRentalsCount = Rental::where('user_id', auth()->id())->count();
    if ($userRentalsCount >= 4) {
        return redirect()->back()->with('error', 'You have already rented the maximum number of books (4).');
    }


    // Check if the book is available
    if ($book->is_available) {
        // Create a rental record
        $rental = new Rental();
        $rental->user_id = auth()->id();
        $rental->book_id = $book->id;
        $rental->rent_date = now();

        $rental->return_date = now()->addDays(3);
        $rental->save();

        // $user = auth()->user();
        // $notification = new ReturnBookReminder($book, $rental->return_date);
        // $user->notify($notification->delay($rental->return_date->subDays(3)));


        $book->is_available = false;
        $book->save();

        return redirect()->back()->with('success', 'Book rented successfully!');
    }

    return redirect()->back()->with('error', 'Book is not available for rent.');
}

public function show(Book $book)
{
    return view('books.show', compact('book'));
}



}
