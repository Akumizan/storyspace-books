@extends('layouts.app')

@section('content')
<div class="container p-0 mb-4 mt-4 rounded-3 container-main">
    <!-- Banner -->
    <div class="px-4 mb-4">
        <img src="{{ asset('storage/books/banner.png') }}" class="w-100 rounded-3" alt="Banner" />
    </div>

    <!-- Collections -->
    <section id="collections" class="py-5">
        <h3 class="text-center">Our Collections</h3>
        <div class="text-center w-50 mx-auto">
            <small class="text-muted-custom">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium rem hic repudiandae tempora libero non?
            </small>
        </div>
    </section>

    <!-- Search Bar -->
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="search-form" action="{{ route('books.index') }}" method="GET">
                    <div class="position-relative">
                        <!-- Search icon -->
                        <span class="position-absolute top-50 start-0 translate-middle-y ms-3 search-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="7"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>

                        <!-- Search input -->
                        <input type="search" name="search" id="search-input" 
                               class="form-control form-control-lg rounded-pill shadow-sm ps-5 search-input" 
                               placeholder="Cari produk..." value="{{ request('search') }}" autocomplete="off">

                        <!-- Clear button -->
                        @if(request('search'))
                            <button type="button" id="clear-search" 
                                    class="btn position-absolute top-50 end-0 translate-middle-y me-3 clear-btn p-0"
                                    style="border: none; background: transparent; font-size: 1.25rem;">×</button>
                        @endif
                    </div>
                </form>
                <small id="result-count" class="d-block mt-2 text-center result-count"></small>
            </div>
        </div>
    </div>

    <!-- Book Grid -->
    <div id="book-grid" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 px-4 pb-5">
        @include('books._books_grid', ['books' => $books])
    </div>

    <!-- Load More Button -->
    @if($books->hasMorePages())
    <div class="text-center mb-5">
        <button id="load-more" class="btn btn-outline-primary" data-page="2">
            <span id="load-more-text">Load More</span>
            <span id="load-more-spinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
        </button>
    </div>
    @endif

    <!-- About Us -->
    <section id="tentang" class="px-4 py-5 about-section text-center mt-5">
        <div class="mx-auto" style="max-width: 800px;">
            <h3 class="mb-4 about-title">Tentang Kami</h3>
            <p class="about-text text-justify">
                Kami adalah tim yang terdiri dari empat orang siswa, yaitu Hamizan sebagai ketua tim, serta Farras, Jundi, dan Narnia sebagai anggota. Dalam prosesnya, setiap anggota memiliki peran penting, mulai dari pengembangan ide, pembuatan konten, hingga desain tampilan. Melalui kolaborasi, kami belajar arti komunikasi, disiplin, dan saling mendukung satu sama lain. Kami berharap karya sederhana ini dapat mencerminkan usaha kami serta memberi inspirasi bagi siapa pun yang melihatnya.
            </p>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let currentPage = 2;
    let isLoading = false;
    let currentSearch = '{{ request('search') }}';

    // Function to update result count
    function updateResultCount() {
        const grid = document.getElementById('book-grid');
        if (!grid) return;
        
        const totalBooks = grid.querySelectorAll('.col').length;
        $('#result-count').text(`Menampilkan ${totalBooks} buku`);
    }

    // Initialize result count
    updateResultCount();

    // Load More functionality
    $('#load-more').on('click', function() {
        if (isLoading) return;
        
        isLoading = true;
        const $button = $(this);
        const $spinner = $('#load-more-spinner');
        const $text = $('#load-more-text');
        
        $button.prop('disabled', true);
        $text.text('Loading...');
        $spinner.removeClass('d-none');
        
        $.ajax({
            url: '{{ route('books.index') }}',
            type: 'GET',
            data: {
                page: currentPage,
                search: currentSearch,
                ajax: true
            },
            success: function(response) {
                if (response.html) {
                    $('#book-grid').append(response.html);
                    currentPage = response.nextPage;
                    
                    // Update result count
                    updateResultCount();
                    
                    // Hide load more button if no more pages
                    if (!response.hasMore) {
                        $button.remove();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading more books:', error);
                console.error('Response:', xhr.responseText);
                alert('Terjadi kesalahan saat memuat buku. Silakan coba lagi.');
            },
            complete: function() {
                isLoading = false;
                $button.prop('disabled', false);
                $text.text('Load More');
                $spinner.addClass('d-none');
            }
        });
    });

    // Search functionality with debounce
    let searchTimeout;
    $('#search-input').on('input', function() {
        clearTimeout(searchTimeout);
        const searchValue = $(this).val();
        currentSearch = searchValue;
        
        // Show/hide clear button
        if (searchValue) {
            $('#clear-search').show();
        } else {
            $('#clear-search').hide();
        }
        
        searchTimeout = setTimeout(function() {
            performSearch(searchValue);
        }, 500);
    });

    // Clear search
    $('#clear-search').on('click', function() {
        $('#search-input').val('');
        currentSearch = '';
        $(this).hide();
        performSearch('');
    });

    // Perform search
    function performSearch(searchTerm) {
        isLoading = true;
        $('#load-more').hide();
        $('#book-grid').html('<div class="col-12 text-center"><div class="spinner-border text-primary" role="status"></div></div>');
        
        $.ajax({
            url: '{{ route('books.index') }}',
            type: 'GET',
            data: {
                search: searchTerm,
                ajax: true
            },
            success: function(response) {
                $('#book-grid').html(response.html);
                currentPage = 2;
                
                // Update result count
                updateResultCount();
                
                // Show/hide load more button
                if (response.hasMore) {
                    $('#load-more').show().data('page', 2);
                } else {
                    $('#load-more').hide();
                }
                
                // Show message if no results
                if (!response.html.trim()) {
                    $('#book-grid').html('<div class="col-12 text-center py-5"><h5 class="text-muted-custom">Tidak ada buku ditemukan</h5></div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Search error:', error);
                $('#book-grid').html('<div class="col-12 text-center py-5"><h5 class="text-danger">Terjadi kesalahan saat mencari</h5></div>');
            },
            complete: function() {
                isLoading = false;
            }
        });
    }

    // Prevent form submission on Enter
    $('#search-form').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });
});
</script>
@endpush