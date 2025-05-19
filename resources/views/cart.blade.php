@extends('layouts.app')

@section('title', 'Korpa - Masline')

@section('content')
    <div class="container py-5">
        <h1 class="section-title">Корпа</h1>
        
        <div class="row">
            <div class="col-lg-8">
                @if(empty($cart))
                    <!-- Empty Cart Message -->
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart text-muted" style="font-size: 5rem;"></i>
                        <h2 class="h4 mt-4">Ваша корпа је празна</h2>
                        <p class="text-muted mb-4">Истражите наше производе и додајте их у корпу</p>
                        <a href="{{ route('catalog') }}" class="btn btn-success">
                            <i class="fas fa-arrow-left me-2"></i>Погледајте производе
                        </a>
                    </div>
                @else
                    <!-- Cart Items -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            @foreach($cart as $id => $item)
                                <div class="cart-item d-flex align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <img src="{{ asset('storage/' . $item['image']) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="cart-item-image rounded"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                    
                                    <div class="ms-3 flex-grow-1">
                                        <h5 class="mb-1">{{ $item['name'] }}</h5>
                                        <div class="text-muted">{{ number_format($item['price'], 2) }} RSD</div>
                                        
                                        <div class="d-flex align-items-center mt-2">
                                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $id }}">
                                                <select name="quantity" class="form-select form-select-sm me-2" style="width: 70px;" onchange="this.form.submit()">
                                                    @for($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </form>
                                            
                                            <form action="{{ route('cart.remove') }}" method="POST" class="ms-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $id }}">
                                                <button type="submit" class="btn btn-link text-danger p-0">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="ms-auto text-end">
                                        <div class="fw-bold">{{ number_format($item['price'] * $item['quantity'], 2) }} RSD</div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('catalog') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Настави куповину
                                </a>
                                
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash me-2"></i>Испразни корпу
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 mb-4">Преглед корпе</h3>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Међузбир:</span>
                            <span>{{ number_format($subtotal, 2) }} RSD</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Достава:</span>
                            <span>{{ number_format($shipping, 2) }} RSD</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Укупно:</strong>
                            <strong>{{ number_format($total, 2) }} RSD</strong>
                        </div>
                        
                        <button class="btn btn-success w-100" {{ empty($cart) ? 'disabled' : '' }}
                            @guest
                                onclick="window.location.href='{{ route('login') }}'"
                            @else
                                onclick="window.location.href='{{ route('checkout') }}'"
                            @endguest>
                            @guest
                                Пријавите се за наставак
                            @else
                                Настави на плаћање
                            @endguest
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cart-item {
            transition: background-color 0.2s ease-in-out;
        }
        .cart-item:hover {
            background-color: #f8f9fa;
        }
        .cart-item-image {
            transition: transform 0.2s ease-in-out;
        }
        .cart-item:hover .cart-item-image {
            transform: scale(1.05);
        }
    </style>
@endsection 