<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends BaseController
{
    public function index()
    {
        $books = Book::all();
        return $this->sendResponse($books, 'Books retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = [
            'name' => $request->name,
            'details' => $request->details,
            'category_id' => $request->category_id,
            'download_link' => $request->download_link,
        ];

        $book = Book::create($input);

        return $this->sendResponse($book->toArray(), 'Book created successfully.');
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (is_null($book)) {
            return $this->sendError('Book not found.');
        }

        return $this->sendResponse($book->toArray(), 'Book retrieved successfully.');
    }

    public function update(Request $request, Book $book)
    {
        $input = $request->all();

        $book->name = $input['name'];
        $book->details = $input['details'];
        $book->category_id = $input['category_id'];
        $book->download_link = $input['download_link'];
        $book->save();

        return $this->sendResponse($book->toArray(), 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return $this->sendResponse($book->toArray(), 'Book deleted successfully.');
    }
}
