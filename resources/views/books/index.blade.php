@extends('layout')

@section('page-content')
    <h1>Bookstore</h1>

    <div class="row">
        <div class="col-lg-10">
            <form method="get" action="{{route('books.index')}}">
                <div class="form-row">
                    <div class="col-8">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search"
                               value="{{ request('search') }}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-default">Search</button>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2 ">
            <p class="text-right"><a href="{{ route('books.create') }}" class="btn btn-primary">New Book</a></p>
        </div>
    </div>

    <table class="table table-striped" >
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
            <th colspan="3" >Action</th>
        </tr>
        @foreach($books as $book)
            <tr>
                <td>{{$book->id }}</td>
                <td>{{$book->title }}</td>
                <td>{{$book->author }}</td>
                <td>{{$book->price }}</td>
                <td><a href="{{ route('books.show', $book->id )  }}">View</a></td>
                
            </tr>
        @endforeach

    </table>

    {{ $books->links() }}

@endsection

