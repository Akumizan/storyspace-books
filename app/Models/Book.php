<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'harga',
        'gambar',
        'deskripsi'
    ];
    
    /**
     * Get the image URL attribute
     */
    public function getImageUrlAttribute()
    {
        // Jika ada file lokal
        if ($this->gambar && Storage::disk('public')->exists($this->gambar)) {
            return asset('storage/' . $this->gambar);
        }
        
        // Fallback ke placeholder
        $placeholder = 'https://via.placeholder.com/400x600.png?text=' . urlencode(substr($this->judul, 0, 20));
        return $placeholder;
    }
    
    /**
     * Scope untuk random order yang konsisten dalam session
     */
    public function scopeRandomOrder($query)
    {
        // Gunakan session ID atau random seed yang konsisten
        $seed = session('random_seed', time());
        session(['random_seed' => $seed]);
        
        return $query->inRandomOrder($seed);
    }
}