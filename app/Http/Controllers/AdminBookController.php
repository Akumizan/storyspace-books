<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBookController extends Controller
{
    /**
     * Method untuk cek admin
     */
    private function checkAdmin()
    {
        if (!auth()->check()) {
            abort(403, 'Silakan login terlebih dahulu');
        }
        
        if (auth()->user()->is_admin != 1) {
            abort(403, 'Akses ditolak. Hanya admin yang boleh mengakses.');
        }
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAdmin();
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkAdmin();
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkAdmin();
        
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string'
        ]);
        
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('books', 'public');
            $validated['gambar'] = $path;
        }
        
        Book::create($validated);
        
        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return redirect()->route('books.show', $book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $this->checkAdmin();
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $this->checkAdmin();
        
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string'
        ]);
        
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($book->gambar && Storage::disk('public')->exists($book->gambar)) {
                Storage::disk('public')->delete($book->gambar);
            }
            
            $path = $request->file('gambar')->store('books', 'public');
            $validated['gambar'] = $path;
        } else {
            unset($validated['gambar']);
        }
        
        $book->update($validated);
        
        return redirect()->route('admin.books.index')
            ->with('success', 'Buku "' . $book->judul . '" berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->checkAdmin();
        
        if ($book->gambar) {
            Storage::disk('public')->delete($book->gambar);
        }
        
        $book->delete();
        
        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}