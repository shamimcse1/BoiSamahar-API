<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
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
        $input = [
            'name' => $request->name,
        ];

        $category = Category::create($input);

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
