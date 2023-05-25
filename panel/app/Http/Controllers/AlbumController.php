<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        return response()->json([
            'albums' => Album::latest()->limit(5)->get(),
        ]);
    }

    public function store(AlbumRequest $request)
    {
        $album = auth()->user()->albums()->create($request->validated());

        return redirect()->route('albums.show', $album);
    }

    public function show(Album $album)
    {
        $photos = $album->photos()
            ->with('faces.character')
            ->latest()
            ->get()
            ->groupBy(fn ($item) => $item->created_at->format('d M'));

        return inertia('Album/Index')
            ->with('photos', $photos)
            ->with('characters', $album->characters()->get())
            ->with('album', $album);
    }

    public function update(AlbumRequest $request, Album $album)
    {
        $album->update($request->validated());

        return redirect()->route('albums.show', $album);
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('dashboard');
    }
}
