@extends('layouts.app')

@section('title', 'Плаћање - Masline')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">Плаћање</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Подаци за доставу</h5>

                    <form action="{{ route('checkout.place-order') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Адреса за доставу</label>
                            <input type="text" class="form-control @error('shipping_address') is-invalid @enderror" 
                                   id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}" required>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="shipping_city" class="form-label">Град</label>
                                <input type="text" class="form-control @error('shipping_city') is-invalid @enderror" 
                                       id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}" required>
                                @error('shipping_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="shipping_zip" class="form-label">Поштански број</label>
                                <input type="text" class="form-control @error('shipping_zip') is-invalid @enderror" 
                                       id="shipping_zip" name="shipping_zip" value="{{ old('shipping_zip') }}" required>
                                @error('shipping_zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="shipping_phone" class="form-label">Телефон</label>
                            <input type="tel" class="form-control @error('shipping_phone') is-invalid @enderror" 
                                   id="shipping_phone" name="shipping_phone" value="{{ old('shipping_phone') }}" required>
                            @error('shipping_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label">Напомене (опционално)</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            Потврди наруџбину
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Преглед наруџбине</h5>

                    @foreach($cart as $id => $item)
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('storage/' . $item['image']) }}" 
                                 alt="{{ $item['name'] }}" 
                                 class="rounded"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                            
                            <div class="ms-3">
                                <h6 class="mb-0">{{ $item['name'] }}</h6>
                                <small class="text-muted">
                                    {{ $item['quantity'] }} x {{ number_format($item['price'], 2) }} RSD
                                </small>
                            </div>
                            
                            <div class="ms-auto">
                                <span class="fw-bold">{{ number_format($item['price'] * $item['quantity'], 2) }} RSD</span>
                            </div>
                        </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Међузбир:</span>
                        <span>{{ number_format($subtotal, 2) }} RSD</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Достава:</span>
                        <span>{{ number_format($shipping, 2) }} RSD</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-0">
                        <strong>Укупно:</strong>
                        <strong>{{ number_format($subtotal + $shipping, 2) }} RSD</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 