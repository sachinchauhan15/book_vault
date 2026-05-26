<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\IndexBookRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    use ApiResponse;

    public function index(IndexBookRequest $request): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 10);

        $books = Book::query()
            ->search($request->string('search')->toString())
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return $this->successResponse('Books fetched successfully', BookResource::collection($books)->resolve(), 200, [
            'current_page' => $books->currentPage(),
            'per_page' => $books->perPage(),
            'total' => $books->total(),
            'last_page' => $books->lastPage(),
        ]);
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books/covers', 'public');
        }

        $book = Book::create($data);

        return $this->successResponse(
            'Book created successfully',
            new BookResource($book),
            201
        );
    }

    public function show(Book $book): JsonResponse
    {
        return $this->successResponse(
            'Book fetched successfully',
            new BookResource($book)
        );
    }

    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('books/covers', 'public');
        }

        $book->update($data);

        return $this->successResponse(
            'Book updated successfully',
            new BookResource($book->refresh())
        );
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return $this->successResponse('Book deleted successfully');
    }
}
