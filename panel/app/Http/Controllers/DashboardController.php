<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $photos = auth()->user()->photos()
            ->with('faces.character')
            ->latest();

        if ($request->has('recent')) {
            switch ($request->recent) {
                case 'month':
                    $photos = $photos->whereDate('created_at', '>', now()->subMonth());
                    break;
                case 'dey':
                    $photos = $photos->whereDate('created_at', '>', now()->subWeek());
                    break;
                default:
                    $photos = $photos->whereDate('created_at', '>', now()->subDay());
                    break;
            }
        }

        $photos = $photos->get()->groupBy(fn ($item) => $item->created_at->format('d M'));

        return inertia('Dashboard/Index')
            ->with('photos', $photos)
            ->with('characters', auth()->user()->characters()->get());
    }
}
