<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function showhomepage(Request $request)
    {

        $query = Book::query();

        if ($request->filled('title')) {
            $title = '%' . $request->input('title') . '%';
            $query->where('title', 'like', $title);
        }

        // Filter by publishing date
        if ($request->filled('published_date')) {
            $query->whereDate('published_date', $request->input('published_date'));
        }

        // Filter by category
        if ($request->filled('category')) {
            $category = trim($request->input('category')); // Trim whitespace from the input
            $query->whereRaw('LOWER(category) like ?', ['%' . strtolower($category) . '%']);
        }

        // $books = Book::simplePaginate(20);
        $books = $query->simplePaginate(20);

        return view('home', compact('books'));
    }
}
