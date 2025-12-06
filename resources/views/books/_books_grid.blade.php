@forelse($books as $book)
<div class="col">
    <div class="card shadow h-100 book-card">
        <div class="position-relative">
            <img src="{{ $book->image_url }}" 
                 class="card-img-top book-image" 
                 alt="{{ $book->judul }}"
                 loading="lazy">
            
            <div class="position-absolute top-0 end-0 m-2">
                <span class="badge bg-danger price-badge">
                    Rp. {{ number_format($book->harga, 0, ',', '.') }}
                </span>
            </div>
        </div>
        
        <div class="card-body d-flex flex-column">
            <h6 class="card-title mb-2">
                {{ Str::limit($book->judul, 50) }}
            </h6>
            
            <p class="text-muted small mb-2">
                <i class="bi bi-person-fill"></i> {{ $book->penulis }}
            </p>
            
            <p class="card-text small flex-grow-1">
                {{ Str::limit($book->deskripsi, 100) }}
            </p>
            
            <div class="mt-auto pt-3">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('books.show', $book->id) }}" 
                       class="btn btn-primary btn-sm detail-btn">
                        <i class="bi bi-eye me-1"></i> Detail
                    </a>
                    
                    @php
                        $nohp = '6282260229236';
                        $pesan = "Halo, saya tertarik dengan buku:\n";
                        $pesan .= "📖 " . $book->judul . "\n";
                        $pesan .= "💰 Rp. " . number_format($book->harga, 0, ',', '.') . "\n";
                        $pesan .= "Bisa dibantu untuk pembelian?";
                        $waLink = "https://wa.me/" . $nohp . "?text=" . urlencode($pesan);
                    @endphp
                    <a href="{{ $waLink }}" 
                       target="_blank" 
                       class="btn btn-success btn-sm whatsapp-btn">
                        <i class="bi bi-whatsapp me-1"></i> Beli
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="text-center py-5">
        <div class="empty-state">
            <i class="bi bi-book" style="font-size: 4rem;"></i>
            <h4 class="mt-3">Tidak ada buku ditemukan</h4>
            <p>Coba gunakan kata kunci pencarian yang berbeda</p>
            @if(request()->has('search'))
                <a href="{{ route('books.index') }}" class="btn btn-outline-primary mt-2">
                    <i class="bi bi-arrow-left"></i> Tampilkan Semua Buku
                </a>
            @endif
        </div>
    </div>
</div>
@endforelse