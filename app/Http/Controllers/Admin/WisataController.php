<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    /**
     * Display list of wisata
     */
    public function index()
    {
        $wisata = Destination::with('category')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.wisata.index', compact('wisata'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.wisata.create', compact('categories'));
    }

    /**
     * Store new wisata
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'entry_fee' => 'nullable|numeric|min:0',
            'opening_hours' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'website' => 'nullable|url',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|array',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'name.required' => 'Nama wisata wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'latitude.required' => 'Latitude wajib diisi.',
            'longitude.required' => 'Longitude wajib diisi.',
            'featured_image.image' => 'File harus berupa gambar.',
            'featured_image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                $file = $request->file('featured_image');

                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store with custom filename
                $path = $file->storeAs('wisata', $filename, 'public');
                $data['featured_image'] = $path;

            } catch (\Exception $e) {
                return back()->withErrors(['featured_image' => 'Gagal mengupload gambar utama.'])->withInput();
            }
        }

        // Handle gallery upload
        if ($request->hasFile('gallery')) {
            try {
                $galleryPaths = [];
                foreach ($request->file('gallery') as $index => $file) {
                    // Generate unique filename
                    $filename = time() . '_' . $index . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Store with custom filename
                    $path = $file->storeAs('wisata/gallery', $filename, 'public');
                    $galleryPaths[] = $path;
                }
                $data['gallery'] = $galleryPaths;

            } catch (\Exception $e) {
                return back()->withErrors(['gallery' => 'Gagal mengupload gambar galeri.'])->withInput();
            }
        }

        Destination::create($data);

        return redirect()->route('admin.wisata.index')->with('success', 'Wisata berhasil ditambahkan.');
    }

    /**
     * Show wisata details
     */
    public function show(Destination $wisata)
    {
        return view('admin.wisata.show', compact('wisata'));
    }

    /**
     * Show edit form
     */
    public function edit(Destination $wisata)
    {
        $categories = Category::all();
        return view('admin.wisata.edit', compact('wisata', 'categories'));
    }

    /**
     * Update wisata
     */
    public function update(Request $request, Destination $wisata)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'entry_fee' => 'nullable|numeric|min:0',
            'opening_hours' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'website' => 'nullable|url',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($wisata->featured_image) {
                Storage::disk('public')->delete($wisata->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('wisata', 'public');
        }

        // Handle gallery upload
        if ($request->hasFile('gallery')) {
            // Delete old gallery images
            if ($wisata->gallery) {
                foreach ($wisata->gallery as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('wisata/gallery', 'public');
            }
            $data['gallery'] = $galleryPaths;
        }

        $wisata->update($data);

        return redirect()->route('admin.wisata.index')->with('success', 'Wisata berhasil diperbarui.');
    }

    /**
     * Delete wisata
     */
    public function destroy(Destination $wisata)
    {
        try {
            // Validate that wisata exists and has valid data
            if (!$wisata || !$wisata->id) {
                \Log::error('Invalid wisata object in destroy method', [
                    'wisata_id' => $wisata->id ?? 'null',
                    'wisata_name' => $wisata->name ?? 'null'
                ]);

                return redirect()->route('admin.wisata.index')
                    ->with('error', 'Wisata tidak ditemukan atau data tidak valid.');
            }

            // Store wisata name and ID before deletion
            $wisataName = $wisata->name;
            $wisataId = $wisata->id;

            // Log for debugging
            \Log::info('Attempting to delete wisata', [
                'id' => $wisataId,
                'name' => $wisataName
            ]);

            // Delete images
            if ($wisata->featured_image) {
                Storage::disk('public')->delete($wisata->featured_image);
            }

            if ($wisata->gallery && is_array($wisata->gallery)) {
                foreach ($wisata->gallery as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            // Delete the wisata record
            $deleted = $wisata->delete();

            if ($deleted) {
                \Log::info('Wisata deleted successfully', [
                    'id' => $wisataId,
                    'name' => $wisataName
                ]);

                return redirect()->route('admin.wisata.index')
                    ->with('success', 'Wisata "' . $wisataName . '" berhasil dihapus.');
            } else {
                \Log::error('Failed to delete wisata', [
                    'id' => $wisataId,
                    'name' => $wisataName
                ]);

                return redirect()->route('admin.wisata.index')
                    ->with('error', 'Gagal menghapus wisata "' . $wisataName . '".');
            }

        } catch (\Exception $e) {
            \Log::error('Exception while deleting wisata', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('admin.wisata.index')
                ->with('error', 'Gagal menghapus wisata. Error: ' . $e->getMessage());
        }
    }
}
