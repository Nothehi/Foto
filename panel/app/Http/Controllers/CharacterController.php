<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;

class CharacterController extends Controller
{
    public function show(Character $character)
    {
        $photos = $character->photos()
            ->with('faces.character')
            ->latest()
            ->get()
            ->groupBy(fn ($item) => $item->created_at->format('d M'));

        return inertia('Character/Index')
            ->with('photos', $photos)
            ->with('characters', auth()->user()->characters()->get())
            ->with('character', $character);
    }

    public function update(CharacterRequest $request, Character $character)
    {
        $character->update([
            'face_id' => $request->face ?? $character->face_id,
            'name' => $request->name ?? $character->name,
        ]);

        return redirect()->back();
    }
}
