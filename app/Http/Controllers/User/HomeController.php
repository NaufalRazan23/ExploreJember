<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show home page with wisata gallery
     */
    public function index(Request $request)
    {
        $query = Destination::with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $wisata = $query->latest()->paginate(12);
        $categories = Category::all();
        $featuredDestinations = Destination::where('is_featured', true)->take(6)->get();

        return view('home', compact('wisata', 'categories', 'featuredDestinations'));
    }

    /**
     * Show wisata detail
     */
    public function show(Destination $destination)
    {
        $relatedWisata = Destination::where('category_id', $destination->category_id)
                                  ->where('id', '!=', $destination->id)
                                  ->take(4)
                                  ->get();

        // Get user's visit form if authenticated and is a user
        $userVisitForm = null;
        if (auth()->check() && auth()->user()->isUser()) {
            $userVisitForm = $destination->visitForms()
                                        ->where('user_id', auth()->id())
                                        ->first();
        }

        // Get total visitors count
        $totalVisitors = $destination->total_visitors;

        return view('wisata.show', compact('destination', 'relatedWisata', 'userVisitForm', 'totalVisitors'));
    }

    /**
     * Search wisata
     */
    public function search(Request $request)
    {
        $search = $request->get('q');

        $wisata = Destination::with('category')
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('address', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")
                            ->paginate(12);

        $categories = Category::all();

        return view('search', compact('wisata', 'categories', 'search'));
    }
}
