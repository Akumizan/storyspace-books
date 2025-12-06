@if ($paginator->hasPages())
<div class="pagination-simple">
    @if (!$paginator->onFirstPage())
        <a href="{{ $paginator->previousPageUrl() }}" class="page-prev">&lt; Prev</a>
    @endif
    
    <span class="page-info">
        Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
    </span>
    
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-next">Next &gt;</a>
    @endif
</div>

<style>
.pagination-simple {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    font-size: 14px;
    margin-top: 20px;
}

.pagination-simple a {
    padding: 5px 12px;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    text-decoration: none;
    color: #0d6efd;
    background: white;
}

.pagination-simple a:hover {
    background-color: #f8f9fa;
}

.pagination-simple .page-info {
    color: #6c757d;
}
</style>
@endif