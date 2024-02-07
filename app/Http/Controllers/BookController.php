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
        if( $request->has('search')){
            $books = Book::where('title','like','%'.$request->search .'%')
            ->orWhere('author','like','%'.$request->search .'%')
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
    
    public function store(Request $request){

        $rules = [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'isbn' => 'required|numeric|digits:13',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules);

        $book = new Book;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->stock = $request->stock;
        $book->save();

        return redirect()->route('books.show',$book->id);


    }
    public function edit($bookId){
        
        $book = Book::find($bookId);

        return view('books.edit')
        ->with('book', $book);
    }
    public function update(Request $request){

        $rules = [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'isbn' => 'required|numeric|digits:13',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules);

        $book = Book::find($request->id);
        $book->title = $request->title;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->stock = $request->stock;
        $book->save();

        echo '<pre>';
        //print_r($book);
        echo '</pre>';

        //return redirect()->route('books.show',$book->id);
        return view('books.show')
        ->with('book', $book);

    }
    public function destroy(Request $request){
        $book = Book::find($request->id);
        $book->delete();

        return redirect()->route('books.index');
    }


    

    


 


}
