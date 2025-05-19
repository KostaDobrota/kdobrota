@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Почетна</a></li>
            <li class="breadcrumb-item"><a href="{{ route('catalog') }}" class="text-decoration-none">Каталог</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Product Image -->
        <div class="col-md-6">
            <div class="position-relative">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid rounded-3 shadow-sm">
                @else
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="Default Product Image" 
                         class="img-fluid rounded-3 shadow-sm">
                @endif
                @if($product->is_featured)
                    <span class="badge bg-warning position-absolute top-0 end-0 m-3">Истакнуто</span>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <div class="mb-4">
                <span class="badge bg-light text-dark fs-6 mb-2">{{ $product->category->name }}</span>
                <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>
                
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span class="fs-3 fw-bold text-success">{{ number_format($product->price, 2) }} RSD</span>
                    @if($product->old_price)
                        <span class="fs-5 text-muted text-decoration-line-through">{{ number_format($product->old_price, 2) }} RSD</span>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <div class="prose fs-5 text-muted">
                    {!! $product->description !!}
                </div>
            </div>

            @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Количина</label>
                        <select name="quantity" id="quantity" class="form-select form-select-lg">
                            @for($i = 1; $i <= min($product->stock, 10); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-shopping-cart me-2"></i>Додај у корпу
                        </button>
                    </div>
                </form>

                <div class="d-flex align-items-center gap-2 text-success">
                    <i class="fas fa-check-circle"></i>
                    <span>Доступно: {{ $product->stock }} комада на залихама</span>
                </div>
            @else
                <div class="d-grid gap-2 mb-3">
                    <button disabled class="btn btn-lg btn-secondary">
                        <i class="fas fa-times-circle me-2"></i>Тренутно није доступно
                    </button>
                </div>
                
                <div class="d-flex align-items-center gap-2 text-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Производ тренутно није на залихама</span>
                </div>
            @endif

            <!-- Additional Product Info -->
            <div class="mt-4 pt-4 border-top">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-truck text-success fa-2x"></i>
                            <div>
                                <h5 class="mb-1">Брза достава</h5>
                                <p class="small text-muted mb-0">2-4 радна дана</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-shield-alt text-success fa-2x"></i>
                            <div>
                                <h5 class="mb-1">Сигурна куповина</h5>
                                <p class="small text-muted mb-0">100% заштита</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
@if(session('success'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <i class="fas fa-check-circle me-2"></i>
            <strong class="me-auto">Успешно!</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
</div>
@endif

@endsection 