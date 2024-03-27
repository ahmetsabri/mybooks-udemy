<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::search($request->query('term', ''))->byPublic(true)->with('user')->latest()->paginate(20);

        return view('welcome', compact('books'));
    }

    public function show(Book $book)
    {
        abort_if(!$book->is_public, 404);
        $isAlreadyLiked = auth()->check() ? $book->likes()->where('user_id', auth()->id())->exists() : false;

        return view('show', compact('book', 'isAlreadyLiked'));
    }

    public function toggleLike(Book $book)
    {
        $like = $book->likes()->where('user_id', auth()->id())->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $newLike = $like->wasRecentlyCreated;

        if (! $newLike) {
            $like->delete();
        }

        $likesCount = $book->formatted_likes_count;

        return response()->json(compact('newLike', 'likesCount'));
    }
}
