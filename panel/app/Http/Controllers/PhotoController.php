<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPhoto;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function show(Photo $photo)
    {
        return inertia('Photo/Index')
            ->with('photo', $photo->load('faces.character', 'albums'))
            ->with('albums', Album::all());
    }

    public function store(Request $request)
    {
        $photo = auth()->user()->photos()->create([
            'name' => $request->file('photo')->getClientOriginalName(),
            'path' => $request->file('photo')->store('photos', 'public'),
        ]);

        ProcessPhoto::dispatch(auth()->user(), $photo)->onQueue('detection');

        return to_route('dashboard')->with('status', 'Photo Uploaded!');
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        return redirect()->back();
    }
}
