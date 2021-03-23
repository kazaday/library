<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::whereNotNull('name');
        if (isset($request->filter)) {
            $books->whereHas('authors', function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->filter . '%')
                    ->orWhere('last_name', 'like', '%' . $request->filter . '%');
            })->orWhere('name', 'like', '%' . $request->filter . '%');
        }
        if (!isset($request->sort)) {
            $request->sort = 'asc';
        }
        if ($request->sort == 'asc') {
            $books->orderBy('name', $request->sort);
            $request->sort = 'desc';
        } elseif ($request->sort == 'desc') {
            $books->orderBy('name', $request->sort);
            $request->sort = 'asc';
        }
        return view('book.index',
            ['books' => $books->paginate(15)->appends(request()->except('page')), 'sort' => $request->sort]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('book.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'poster' => 'max:2048|image|mimes:jpeg,jpg,png,gif',
        ]);
        if (!is_null($request->file('poster')) && $request->file('poster')->isValid()) {
            $imagePath = $request->file('poster')->store('public/image');

            $imagePath = explode('/', $imagePath);

            $imagePath = $imagePath[2];

            $validated['poster'] = $imagePath;

        } else {
            $validated['poster'] = 'noposter.png';
        }
        $book = Book::create($validated);
        $book = Book::find($book->id);
        $book->authors()->attach($request->author);
        return redirect(route('book.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $book = Book::find($id);
        $authors = Author::all();
        return view('book.show', ['book' => $book, 'authors' => $authors]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $authors = Author::all();
        return view('book.create', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'poster' => 'max:2048|image|mimes:jpeg,jpg,png,gif',
        ]);
        $book = Book::find($id);

        if (!is_null($request->file('poster')) && $request->file('poster')->isValid()) {
            Storage::delete('public/image/' . $book->poster);
            $imagePath = $request->file('poster')->store('public/image');
            $imagePath = explode('/', $imagePath);
            $imagePath = $imagePath[2];
            $validated['poster'] = $imagePath;
        } else {
            $validated['poster'] = 'noposter.png';
        }

        $book->update($validated);
        $book->authors()->detach();
        $book->authors()->attach($request->author);
        return redirect(route('book.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book->poster!='noposter.png'){
            Storage::delete('public/image/' . $book->poster);
        }
        $book->delete();
        return redirect(route('book.index'));
    }
}
