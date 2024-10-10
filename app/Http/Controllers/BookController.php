<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'title' => 'required|string',
            'cover' => 'string',
            'description' => 'string',
            'author_id' => 'required|integer|exists:authors,id',
            'publisher_id' => 'required|integer|exists:publishers,id',
            'published_year' => 'required|integer',
            'isbn' => 'required|string',
            'stock' => 'required|integer',
        ]);

        Book::create($credentials);

        return response()->json([
            'status' => 'success',
            'message' => 'Book created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json([
            'status' => 'success',
            'data' => new BookResource($book),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $credentials = $request->validate([
            'title' => 'string',
            'cover' => 'string',
            'description' => 'string',
            'author_id' => 'integer|exists:authors,id',
            'publisher_id' => 'integer|exists:publishers,id',
            'published_year' => 'integer',
            'isbn' => 'string',
            'stock' => 'integer',
        ]);

        $book->update($credentials);

        return response()->json([
            'status' => 'success',
            'message' => 'Book updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully',
        ]);
    }
}
