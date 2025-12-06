@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <img src="{{ $book->image_url }}" 
                     class="card-img-top img-fluid rounded" 
                     alt="{{ $book->judul }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="card-title">{{ $book->judul }}</h1>
                    <h4 class="text-danger">Rp. {{ number_format($book->harga, 0, ',', '.') }}</h4>
                    
                    <div class="mb-4">
                        <h5><i class="bi bi-person"></i> Penulis</h5>
                        <p class="fs-5">{{ $book->penulis }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5><i class="bi bi-card-text"></i> Deskripsi</h5>
                        <p class="lead">{{ $book->deskripsi }}</p>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex">
                        @php
                            $nohp = '6282260229236';
                            $pesan = "Halo, saya mau pesan buku ini:\n";
                            $pesan .= "📖 Judul: " . $book->judul . "\n";
                            $pesan .= "👤 Penulis: " . $book->penulis . "\n";
                            $pesan .= "💰 Harga: Rp. " . number_format($book->harga, 0, ',', '.') . "\n";
                            $waLink = "https://wa.me/" . $nohp . "?text=" . urlencode($pesan);
                        @endphp
                        <a href="{{ $waLink }}" target="_blank" class="btn btn-warning btn-lg me-2">
                            <i class="bi bi-whatsapp"></i> Beli via WhatsApp
                        </a>
                        
                        <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection