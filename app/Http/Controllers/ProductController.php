<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function landing(): View
    {
        $products = product::query()->latest()->get();
        return view('layouts.landing', compact('products'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = product::query()->latest()->get();
        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(
            [
                'nama_produk' => ['required', 'string', 'max:100'], 
                'deskripsi' => ['required', 'string'],
                 'harga' => ['required', 'integer', 'min:0']
                 ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }

        Product::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $produk): View
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $produk): RedirectResponse 
    {
        $data = $request->only(['nama_produk', 'deskripsi', 'harga']);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }
        $produk->update($data);

        return redirect()
        ->route('produk.index')
       ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $produk): RedirectResponse
    {
        $produk->delete();

        return redirect()
        ->route('produk.index')
       ->with('success', 'Produk berhasil dihapus.');
    }

    private function validationMessages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.max' => ' Nama maksimal 100 kaarkter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.integer' => 'Harga harus berupa bilangan bulat.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'gambar.max' => 'Nama file gambar maksimal 255 karakter.',
        ];
    }
}
