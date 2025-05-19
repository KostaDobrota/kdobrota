@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">Добродошли, {{ Auth::user()->name }}!</h4>
                            <p class="mb-0">Управљајте садржајем и производима са лакоћом.</p>
                        </div>
                        <div>
                            <i class="fas fa-edit fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="fas fa-box text-primary fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Укупно производа</h6>
                            <h3 class="mb-0">{{ $totalProducts }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="fas fa-star text-success fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Истакнути производи</h6>
                            <h3 class="mb-0">{{ $featuredProducts }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="fas fa-exclamation-triangle text-warning fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Мала залиха</h6>
                            <h3 class="mb-0">{{ $lowStockProducts }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="fas fa-tags text-info fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Категорије</h6>
                            <h3 class="mb-0">{{ $totalCategories }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Products -->
    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Брзе акције</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('editor.products.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Додај нови производ
                        </a>
                        <a href="{{ route('editor.categories.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-folder-plus me-2"></i>Додај нову категорију
                        </a>
                        <a href="{{ route('editor.products.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>Прегледај све производе
                        </a>
                        <a href="{{ route('editor.categories.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-tags me-2"></i>Управљај категоријама
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Products -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Недавно додати производи</h5>
                        <a href="{{ route('editor.products.index') }}" class="btn btn-sm btn-link text-decoration-none">
                            Види све
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 ps-3">Производ</th>
                                    <th class="border-0">Категорија</th>
                                    <th class="border-0">Цена</th>
                                    <th class="border-0">Залиха</th>
                                    <th class="border-0 text-end pe-3">Акције</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProducts as $product)
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($product->image_path)
                                                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="rounded" 
                                                         width="40" height="40" 
                                                         style="object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('images/logo.png') }}" 
                                                         alt="Default Product Image" 
                                                         class="rounded" 
                                                         width="40" height="40" 
                                                         style="object-fit: cover;">
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $product->name }}</h6>
                                                <small class="text-muted">Додато: {{ $product->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $product->category->name }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($product->price, 2) }} RSD</td>
                                    <td>
                                        @if($product->stock > 10)
                                            <span class="text-success">{{ $product->stock }}</span>
                                        @elseif($product->stock > 0)
                                            <span class="text-warning">{{ $product->stock }}</span>
                                        @else
                                            <span class="text-danger">0</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-3">
                                        <a href="{{ route('editor.products.edit', $product->id) }}" 
                                           class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('product.show', $product->slug) }}" 
                                           class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
@endsection 