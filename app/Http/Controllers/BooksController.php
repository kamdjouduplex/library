<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(){
        
        return Book::all();
    }
    public function store(){
        
        Book::create($this->validateData());
        return redirect('/books');
    }

    public function update(Book $book){

        $book->update($this->validateData());
        return redirect('/books/'.$book->id);
    }

    public function destroy(Book $book){

        $book->delete();

        return redirect('/books');
    }

    private function validateData()
    {
        return request()->validate([
            'title'=>'required',
            'author'=>'required'
        ]);
    }
}
