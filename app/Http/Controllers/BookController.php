<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//model added
use App\Models\Book;
use Session;
use PDF;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(5);
        return view('books.index', ['books' => $books]);
    }
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show', ['book' => $book]);
    }
    public function create()
    {
        return view('books.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'isbn' => 'required|min:8|unique:books'
        ]);
        Book::create([
            'name' => $request->name,
            'isbn' => $request->isbn,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);
        Session::flash('success', 'Books added sucessfully');
        return back();
    }
    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit', ['book' => $book]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'isbn' => 'required|min:8|unique:books'
        ]);
        Book::where('id', $id)->update([
            'name' => $request->name,
            'isbn' => $request->isbn,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);
        Session::flash('success', 'Books updated sucessfully');
        return back();
    }
    public function destroy($id)
    {
        Book::where('id', $id)->delete();
        Session::flash('success', 'Books deleted sucessfully');
        return back();
    }
    public function search(Request $request)
    {
        $name = $request->name;
        $books = Book::where('name', 'like', '%' . $name . '%')->paginate(5);
        return view('books.index', ['books' => $books]);
    }
    public function generatePdf()
    {
        $books = Book::get();
        $pdf = PDF::loadView('books.download', compact('books'));
        return $pdf->download('Books.pdf');
    }
}
