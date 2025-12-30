<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = \App\Models\Product::where('vendor_id', auth()->id())->latest()->get();
        return view('dashboards.vendor.products', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:10240',
        ]);

        // handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $validated['image'] = $path;
        }

        $validated['vendor_id'] = auth()->id();

        \App\Models\Product::create($validated);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $product = \App\Models\Product::where('vendor_id', auth()->id())->findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:10240',
        ]);

        // handle new image upload and delete old
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('product_images', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $product = \App\Models\Product::where('vendor_id', auth()->id())->findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
