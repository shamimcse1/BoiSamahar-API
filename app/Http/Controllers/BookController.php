<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
       $books = Book::all();
         return view('backend.books.index', compact('books'));
    }


    public function create()
    {
        $books = Book::all();
        $categories = Category::all();
        return view('backend.books.create', compact('books', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:191',
            'download_link' => 'required',
            'details' => 'required',
            'category_id' => 'required',
        ]);
        try {
            Book::create([
                'name' => $request->name,
                'details' => $request->details,
                'download_link' => $this->uploadpdf(request()->file('download_link')),
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('books.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

    }

 
    public function show($id)
    {
        $book = Book::find($id);
        return view('backend.books.show', compact('book'));
        
    }

  
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('backend.books.edit', compact('book', 'categories'));
    }

   
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        try {
            $requestData = [
                'name' => $request->name,
                'details' => $request->details,
                'category_id' => $request->category_id,
            ];

            if ($request->hasFile('download_link')) {
                $download_link = $request->file('download_link');
                $name = time() . '.' . $download_link->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/books/');
                $download_link->move($destinationPath, $name);
                $book->download_link = $name;
            }

            $book->update($requestData);

            return redirect()->route('books.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy($id)
    {
        $book = Book::find($id);
        $unlink = storage_path('app/public/books/' . $book->download_link);
        if (file_exists($unlink)) {
            unlink($unlink);
        }
        $book->delete();

        // Redirect
        return redirect()->route('books.index');
    }

    public function uploadpdf($file)
    {
        $name = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = storage_path('/app/public/books/');
        $file->move($destinationPath, $name);
        return $name;
    }
}
