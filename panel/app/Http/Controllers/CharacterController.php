<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;

class CharacterController extends Controller
{
    public function update(CharacterRequest $request, Character $character)
    {
        $character->update([
            'face_id' => $request->face ?? $character->face_id,
            'name' => $request->name ?? $character->name,
        ]);

        return redirect()->back();
    }
}
