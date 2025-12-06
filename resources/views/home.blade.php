@extends('layouts.app')

@section('content')
<div class="container p-0 mb-4 mt-4 rounded-3 bg-white">
    <!-- Banner -->
    <div class="px-4 mb-4">
        <img src="{{ asset('images/banner.png') }}" class="w-100 rounded-3" alt="Banner" />
    </div>

    <!-- Collections -->
    <section id="collections" class="py-5">
        <h3 class="text-center">Our Collections</h3>
        <div class="text-center w-50 mx-auto fw-light">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium rem hic repudiandae tempora libero non?
        </div>
    </section>

    <!-- Search Bar -->
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('books.index') }}" method="GET">
                    <div class="position-relative">
                        <!-- Search icon -->
                        <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="7"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>

                        <!-- Search input -->
                        <input type="search" name="search" class="form-control form-control-lg rounded-pill shadow-sm ps-5" 
                               placeholder="Cari produk..." value="{{ request('search') }}" autocomplete="off">

                        <!-- Clear button -->
                        @if(request('search'))
                            <a href="{{ route('books.index') }}" class="btn position-absolute top-50 end-0 translate-middle-y me-3 text-muted p-0"
                               style="border: none; background: transparent; font-size: 1.25rem;">×</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Book Grid -->
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 p-5">
        @foreach($books as $book)
        <div class="col">
            <div class="card shadow h-100">
                <img src="{{ asset('storage/' . $book->gambar) }}" class="card-img-top" alt="{{ $book->judul }}">
                <div class="card-body">
                    <h6 class="card-title">{{ $book->judul }}</h6>
                    <p class="card-text small text-muted">{{ Str::limit($book->deskripsi, 100) }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="text-danger fw-bold">Rp. {{ number_format($book->harga, 0, ',', '.') }}</span>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center my-4">
        {{ $books->links() }}
    </div>

    <!-- About Us -->
    <section id="tentang" class="px-4 py-5 bg-secondary text-center mt-5">
        <div class="mx-auto" style="max-width: 800px;">
            <h3 class="text-white mb-4">Tentang Kami</h3>
            <p class="text-white text-justify">
                Kami adalah tim yang terdiri dari empat orang siswa, yaitu Hamizan sebagai ketua tim, serta Farras, Jundi, dan Narnia sebagai anggota. Dalam prosesnya, setiap anggota memiliki peran penting, mulai dari pengembangan ide, pembuatan konten, hingga desain tampilan. Melalui kolaborasi, kami belajar arti komunikasi, disiplin, dan saling mendukung satu sama lain. Kami berharap karya sederhana ini dapat mencerminkan usaha kami serta memberi inspirasi bagi siapa pun yang melihatnya.
            </p>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal content akan diisi via AJAX -->
        </div>
    </div>
</div>
@endsection