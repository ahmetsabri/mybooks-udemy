<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::search(request()->query('term', ''))->where('user_id', auth()->id())->paginate(20, [
            'id',
            'user_id',
            'image_url',
            'title',
            'created_at',
        ]);

        return view('my_books.index', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $url = null;
        if ($request->hasFile('image')) {
            $url = $request->file('image')->store('books/images', ['disk' => 'public']);
        }
        auth()->user()->books()->create([
            'title' => $request->title,
            'summary' => $request->summary,
            'image_url' => $url,
            'is_public' => $request->boolean('is_public')
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        Gate::authorize('update', $book);

        return view('my_books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        Gate::authorize('update', $book);

        abort_if($book->user_id != auth()->id(), 403);

        $book->fill($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $url = $request->file('image')->store('books/images', ['disk' => 'public']);
            if ($book->image_url) {
                Storage::delete('public/'.$book->image_url);
            }
            $book->image_url = $url;
        }
        $book->is_public = $request->boolean('is_public');
        $book->save();

        return back();
    }

    public function deleteImage(Book $book)
    {
        Gate::authorize('delete', $book);
        if ($book->image_url) {
            Storage::delete('public/'.$book->image_url);
        }
        $book->update(['image_url' => null]);

        return response(status: 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Gate::authorize('delete', $book);

        if ($book->image_url) {
            Storage::delete('public/'.$book->image_url);
        }

        $book->delete();

        return response(status: 204);
    }
}
