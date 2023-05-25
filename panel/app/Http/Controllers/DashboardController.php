<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $photos = auth()->user()->photos()
            ->with('faces.character')
            ->latest()
            ->get()
            ->groupBy(fn ($item) => $item->created_at->format('d M'));

        return inertia('Dashboard/Index')
            ->with('photos', $photos)
            ->with('characters', auth()->user()->characters()->get());
    }
}
