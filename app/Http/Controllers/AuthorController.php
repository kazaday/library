<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $author = Author::whereNotNull('first_name');
        if (isset($request->filter)) {
            $author->where('first_name', 'like', '%' . $request->filter . '%')
                ->orWhere('last_name', 'like', '%' . $request->filter . '%');
        }
        if (!isset($request->sort)) {
            $request->sort = 'asc';
        }
        if ($request->sort == 'asc') {
            $author->orderBy('last_name', $request->sort);
            $request->sort = 'desc';
        } elseif ($request->sort == 'desc') {
            $author->orderBy('last_name', $request->sort);
            $request->sort = 'asc';
        }
        return view('author.index', ['authors' => $author->paginate(15)->appends(request()->except('page')), 'sort' => $request->sort]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('author.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'second_name' => 'max:255',
        ]);
        Author::create($validated);
        return redirect(route('authors'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $author = Author::find($id);
        return view('author.show', ['author' => $author]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param \App\Models\author $author
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('author.create', ['author' => $author]);
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'second_name' => 'max:255',
        ]);
        $author = Author::find($id);
        $author->update($validated);
        return redirect(route('authors'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();
        return redirect(route('authors'));
    }
}
