<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }


    public function index(Request $request)
    {
        // fetch books data from books table
        if( $request->has('search')   ){
            $books = Book::where('title', 'like', '%'.$request->search.'%' )
                ->orWhere('author', 'like', '%'.$request->search.'%' )
                ->paginate(20);
        } else {
            $books = Book::paginate(20);
        }
        // pass books data to view
        return view('books.index')
            ->with('books', $books);


    }

    public function show($book_id)
    {
        $book = Book::find($book_id);

        return view('books.show')
            ->with('book', $book);

    }

    public function create()
    {
        return view('books.create');
    }



    

    





}
