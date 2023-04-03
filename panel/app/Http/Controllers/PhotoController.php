<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPhoto;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $photo = auth()->user()->photos()->create([
            'name' => $request->file('photo')->getClientOriginalName(),
            'path' => $request->file('photo')->store('photos', 'public'),
        ]);

        ProcessPhoto::dispatch(auth()->user(), $photo)->onQueue('detection');

        return to_route('dashboard')->with('status', 'Photo Uploaded!');
    }
}
