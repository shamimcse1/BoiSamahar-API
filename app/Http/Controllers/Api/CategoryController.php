<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index()
    {
        $categories = Category::all();
        return $this->sendResponse($categories, 'Categories retrieved successfully.');
    }

    public function store(Request $request)
    {

        $categories = Category::all();
        $book = Book::all();
        // Data insert
        $category = new Category;
        $category->name = $request->name;
        if ($book == null || $book->count() == 0 || isset($categories->books) == null) {
            $category->number_of_book = 0;
        } else {
            $category->number_of_book = $categories->books->count();
        }
        $category->save();

        return $this->sendResponse($category->toArray(), 'Category created successfully.');
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return $this->sendError('Category not found.');
        }

        return $this->sendResponse($category->toArray(), 'Category retrieved successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $input = $request->all();

        $category->name = $input['name'];
        $category->save();

        return $this->sendResponse($category->toArray(), 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->sendResponse($category->toArray(), 'Category deleted successfully.');
    }
}
