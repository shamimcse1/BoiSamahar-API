<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::apiResource('categories', CategoryController::class);
Route::get('categories/search/{id}', function ($id) {
    $books = Book::where('category_id', $id)->get();
    foreach ($books as $book) {
        $book->download_link = url('storage/books/' . $book->download_link);
    }

        $response = [
            'success' => true,
            'data'    => $books,
            'message' => ' search by categories of Books retrieved successfully.',
        ];


        return response()->json($response, 200);

    
});
Route::apiResource('books', BookController::class);

// Route::apiResource('categories', CategoryController::class)->middleware('auth:sanctum');
// Route::get('categories/search/{id}', function ($id) {
//     return Book::where('category_id', $id)->get();
    
// })->middleware('auth:sanctum');
// Route::apiResource('books', BookController::class)->middleware('auth:sanctum');