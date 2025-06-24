<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::with('category')->paginate(12);
        $categories = Category::all();
        return view('destinations.index', compact('destinations', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('destinations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'entry_fee' => 'nullable|numeric',
            'opening_hours' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'website' => 'nullable|url',
            'facilities' => 'nullable|array'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('destinations', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('gallery', 'public');
            }
            $validated['gallery'] = $gallery;
        }

        Destination::create($validated);

        return redirect()->route('destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
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

        return view('destinations.show', compact('destination', 'relatedWisata', 'userVisitForm', 'totalVisitors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        $categories = Category::all();
        return view('destinations.edit', compact('destination', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'featured_image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'entry_fee' => 'nullable|numeric',
            'opening_hours' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'website' => 'nullable|url',
            'facilities' => 'nullable|array'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('destinations', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('gallery', 'public');
            }
            $validated['gallery'] = $gallery;
        }

        $destination->update($validated);

        return redirect()->route('destinations.show', $destination)
            ->with('success', 'Destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }

    /**
     * Search destinations by name or description
     */
    public function search(Request $request)
    {
        $query = $request->get('query');

        $destinations = Destination::query()
            ->with('category')
            ->where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate(12);

        $categories = Category::all();
        return view('destinations.index', compact('destinations', 'categories'));
    }

    /**
     * Filter destinations by category
     */
    public function byCategory(Category $category)
    {
        $destinations = $category->destinations()->paginate(12);
        $categories = Category::all();
        return view('destinations.index', compact('destinations', 'categories'));
    }

    /**
     * Filter destinations by various criteria
     */
    public function filter(Request $request)
    {
        $query = Destination::query()->with('category');

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('entry_fee', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('entry_fee', '<=', $request->max_price);
        }

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by featured status
        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $destinations = $query->paginate(12);
        $categories = Category::all();
        return view('destinations.index', compact('destinations', 'categories'));
    }
}
