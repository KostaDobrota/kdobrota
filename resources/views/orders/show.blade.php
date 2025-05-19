@extends('layouts.app')

@section('title', 'Наруџбина #' . $order->id . ' - Masline')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title mb-0">Наруџбина #{{ $order->id }}</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Назад на наруџбине
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Order Items -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Производи</h5>

                    @foreach($order->items as $item)
                        <div class="d-flex align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                 alt="{{ $item->product_name }}" 
                                 class="rounded"
                                 style="width: 80px; height: 80px; object-fit: cover;">
                            
                            <div class="ms-3 flex-grow-1">
                                <h6 class="mb-1">{{ $item->product_name }}</h6>
                                <div class="text-muted">
                                    {{ $item->quantity }} x {{ number_format($item->price, 2) }} RSD
                                </div>
                            </div>
                            
                            <div class="ms-auto text-end">
                                <div class="fw-bold">{{ number_format($item->subtotal, 2) }} RSD</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Details -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Подаци за доставу</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Адреса:</strong></p>
                            <p class="text-muted">{{ $order->shipping_address }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Град:</strong></p>
                            <p class="text-muted">{{ $order->shipping_city }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Поштански број:</strong></p>
                            <p class="text-muted">{{ $order->shipping_zip }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Телефон:</strong></p>
                            <p class="text-muted">{{ $order->shipping_phone }}</p>
                        </div>
                        @if($order->notes)
                            <div class="col-12">
                                <p class="mb-1"><strong>Напомене:</strong></p>
                                <p class="text-muted">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Преглед наруџбине</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Статус:</span>
                        <span>
                            @switch($order->status)
                                @case('pending')
                                    <span class="badge bg-warning">На чекању</span>
                                    @break
                                @case('processing')
                                    <span class="badge bg-info">У обради</span>
                                    @break
                                @case('completed')
                                    <span class="badge bg-success">Завршено</span>
                                    @break
                                @case('cancelled')
                                    <span class="badge bg-danger">Отказано</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                            @endswitch
                        </span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Датум:</span>
                        <span>{{ $order->created_at->format('d.m.Y.') }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Међузбир:</span>
                        <span>{{ number_format($order->subtotal, 2) }} RSD</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Достава:</span>
                        <span>{{ number_format($order->shipping, 2) }} RSD</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Укупно:</strong>
                        <strong>{{ number_format($order->total, 2) }} RSD</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 