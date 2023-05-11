<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $photos = auth()->user()->photos()->with('faces.character');
        $character = null;

        if ($request->has('character')) {
            $photos = $photos->whereHas('characters', fn ($query) => $query->where('key', $request->character));
            $character = Character::with('faces')->where('key', $request->character)->first();
        }

        return inertia('Dashboard/Index')
            ->with('photos', $photos->get()->groupBy(fn ($item) => $item->created_at->format('d M')))
            ->with('characters', auth()->user()->characters())
            ->with('character', $character);
    }
}
