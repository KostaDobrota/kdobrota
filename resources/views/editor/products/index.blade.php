@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-0">Производи</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('editor.index') }}">Контролна табла</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Производи</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('editor.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Додај нови производ
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 100px">Слика</th>
                            <th scope="col">Назив</th>
                            <th scope="col">Категорија</th>
                            <th scope="col" class="text-end">Цена</th>
                            <th scope="col" class="text-center">Залиха</th>
                            <th scope="col" class="text-center">Статус</th>
                            <th scope="col" class="text-end">Акције</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-thumbnail"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-image text-secondary" style="font-size: 1.5rem;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <h6 class="mb-1">{{ $product->name }}</h6>
                                <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td class="text-end">
                                <span class="fw-medium">{{ number_format($product->price, 2) }}</span>
                                <small class="text-muted">RSD</small>
                            </td>
                            <td class="text-center">
                                @if($product->stock > 10)
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="badge bg-warning">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Нема на стању</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($product->is_featured)
                                    <span class="badge bg-primary">Истакнуто</span>
                                @else
                                    <span class="badge bg-secondary">Стандардно</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('product.show', $product->slug) }}" 
                                       class="btn btn-sm btn-outline-info"
                                       data-bs-toggle="tooltip"
                                       title="Погледај на сајту">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('editor.products.edit', $product) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       data-bs-toggle="tooltip"
                                       title="Измени производ">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('editor.products.toggle-featured', $product) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-sm {{ $product->is_featured ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                data-bs-toggle="tooltip"
                                                title="{{ $product->is_featured ? 'Уклоni sa iстакнутих' : 'Додај у iстакнуте' }}">
                                            <i class="fas {{ $product->is_featured ? 'fa-star' : 'fa-star' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-box fa-2x mb-3"></i>
                                    <p class="mb-0">Нема производа за приказ</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease-in-out;
    }
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
    }
    .pagination {
        margin-bottom: 0;
    }
    .page-link {
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        margin: 0 0.125rem;
        border: none;
        color: var(--bs-primary);
        background-color: var(--bs-light);
        transition: all 0.2s ease-in-out;
    }
    .page-link:hover {
        background-color: var(--bs-primary);
        color: white;
        transform: translateY(-1px);
    }
    .page-item.active .page-link {
        background-color: var(--bs-primary);
        color: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .page-item.disabled .page-link {
        background-color: var(--bs-light);
        color: var(--bs-gray-500);
    }
    .img-thumbnail {
        padding: 0.25rem;
        border-radius: 0.375rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
@endsection 