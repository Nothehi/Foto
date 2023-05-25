<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumPhotoRequest;
use App\Models\Album;
use App\Models\Photo;

class AlbumPhotoController extends Controller
{
    public function store(AlbumPhotoRequest $request, Album $album)
    {
        $album->photos()->attach($request->validated('photo'));

        return redirect()->back();
    }

    public function destroy(Album $album, Photo $photo)
    {
        $album->photos()->detach($photo->id);

        return redirect()->back();
    }
}
