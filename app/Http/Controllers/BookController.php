<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $itemsPerPage = 9;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        // Generate atau ambil random seed dari session
        if (!$request->session()->has('random_seed')) {
            $request->session()->put('random_seed', time());
        }
        $seed = $request->session()->get('random_seed');
        
        if ($request->ajax()) {
            // Untuk request AJAX (load more)
            $page = $request->input('page', 1);
            
            $books = Book::when($query, function ($q) use ($query) {
                return $q->where('judul', 'like', "%{$query}%")
                        ->orWhere('deskripsi', 'like', "%{$query}%");
            })
            ->orderByRaw("RAND({$seed})") // PAKAI SEED YANG SAMA
            ->paginate($this->itemsPerPage, ['*'], 'page', $page);
            
            $html = view('books._books_grid', compact('books'))->render();
            
            return response()->json([
                'html' => $html,
                'hasMore' => $books->hasMorePages(),
                'nextPage' => $books->currentPage() + 1,
                'total' => $books->total()
            ]);
        }
        
        // Untuk request biasa (initial load)
        $books = Book::when($query, function ($q) use ($query) {
            return $q->where('judul', 'like', "%{$query}%")
                    ->orWhere('deskripsi', 'like', "%{$query}%");
        })
        ->orderByRaw("RAND({$seed})") // PAKAI SEED YANG SAMA
        ->paginate($this->itemsPerPage);
        
        return view('books.index', compact('books'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
}