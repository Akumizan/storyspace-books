@if($books->count() > 0)
<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $loop->iteration + (($books->currentPage() - 1) * $books->perPage()) }}</td>
                <td>
                    <img src="{{ $book->image_url }}" 
                         alt="{{ $book->judul }}" 
                         style="width: 50px; height: 70px; object-fit: cover;"
                         class="rounded border">
                </td>
                <td>{{ $book->judul }}</td>
                <td>{{ $book->penulis }}</td>
                <td>Rp. {{ number_format($book->harga, 0, ',', '.') }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        {{-- Tombol Lihat --}}
                        <a href="{{ route('books.show', $book->id) }}" 
                           class="btn btn-outline-info" 
                           target="_blank" 
                           title="Lihat Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.books.edit', $book->id) }}" 
                           class="btn btn-outline-warning" 
                           title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        
                        {{-- Tombol Hapus --}}
                        <a href="#" 
                           class="btn btn-outline-danger delete-btn" 
                           title="Hapus"
                           data-id="{{ $book->id }}"
                           data-judul="{{ $book->judul }}">
                            <i class="bi bi-trash"></i>
                        </a>
                        
                        {{-- Form Hapus (Hidden) --}}
                        <form id="delete-form-{{ $book->id }}" 
                              action="{{ route('admin.books.destroy', $book->id) }}" 
                              method="POST" 
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ===== PAGINATION DI SINI ===== -->
@if($books->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $books->links('pagination.simple') }}
</div>
@endif
<!-- ============================= -->

@else
<div class="text-center py-5">
    <div class="alert alert-info">
        <h5 class="mb-3"><i class="bi bi-info-circle"></i> Belum ada data buku</h5>
        <p class="mb-4">Silakan tambahkan buku pertama Anda.</p>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Buku Pertama
        </a>
    </div>
</div>
@endif