<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $books = Book::all();
         return view('backend.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        return view('backend.books.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:191',
            'download_link' => 'required',
            'details' => 'required',
            'category_id' => 'required',
        ]);

        // If include file, upload
        if($request->file()) {
            $fileName = time().'_'.$request->download_link->getClientOriginalName();
            $filePath = $request->file('download_link')->storeAs('bookimg', $fileName, 'public');
            $path = '/storage/'.$filePath;
        }

        // Data insert
        $book = new Book;
        $book->name = $request->name;
        $book->download_link = $path;
        $book->details = $request->details;
        $book->category_id = $request->category_id;
        $book->save();

        // Redirect
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('backend.books.show', compact('book'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('backend.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:191',
            'download_link' => 'required',
            'details' => 'required',
            'category_id' => 'required',
        ]);

        // If include file, upload
        if($request->file()) {
            $fileName = time().'_'.$request->download_link->getClientOriginalName();
            $filePath = $request->file('download_link')->storeAs('bookimg', $fileName, 'public');
            $path = '/storage/'.$filePath;
        }

        // Data insert
        $book = Book::find($id);
        $book->name = $request->name;
        $book->download_link = $path;
        $book->details = $request->details;
        $book->category_id = $request->category_id;
        $book->save();

        // Redirect
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->unlink($book->download_link);
        $book->delete();

        // Redirect
        return redirect()->route('books.index');
    }
}
