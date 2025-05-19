@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-0">Категорије</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('editor.index') }}">Контролна табла</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Категорије</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('editor.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Додај нову категорију
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 ps-3">Назив</th>
                            <th class="border-0">Опис</th>
                            <th class="border-0">Број производа</th>
                            <th class="border-0 text-end pe-3">Акције</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="ps-3">
                                <h6 class="mb-0">{{ $category->name }}</h6>
                            </td>
                            <td>
                                <p class="text-muted mb-0">{{ Str::limit($category->description, 100) }}</p>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $category->products_count }} производа
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <a href="{{ route('editor.categories.edit', $category) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease-in-out;
    }
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
</style>
@endpush
@endsection 