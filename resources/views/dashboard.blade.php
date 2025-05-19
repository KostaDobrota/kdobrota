@extends('layouts.app')

@section('title', 'Контролна табла - Masline')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">Моја контролна табла</h1>

    <div class="row g-4">
        <!-- Orders Summary Card -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Укупно наруџбина</h6>
                            <h2 class="mb-0 text-dark">{{ auth()->user()->orders()->count() }}</h2>
                        </div>
                        <div class="icon-shape bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                    </div>
                    
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-success btn-sm">
                        Прегледај све наруџбине
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Мој профил</h6>
                            <h5 class="mb-0 text-dark">{{ auth()->user()->name }}</h5>
                            <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    </div>
                    
                    <a href="{{ route('profile') }}" class="btn btn-outline-primary btn-sm">
                        Уреди профил
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Недавне наруџбине</h5>

                    @if($orders->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-box-open text-muted" style="font-size: 3rem;"></i>
                            <h6 class="mt-3">Немате наруџбина</h6>
                            <p class="text-muted mb-3">Погледајте наше производе и направите своју прву наруџбину</p>
                            <a href="{{ route('catalog') }}" class="btn btn-success">
                                <i class="fas fa-shopping-cart me-2"></i>Погледајте производе
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0">Број наруџбине</th>
                                        <th class="border-0">Датум</th>
                                        <th class="border-0">Статус</th>
                                        <th class="border-0">Укупно</th>
                                        <th class="border-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('d.m.Y.') }}</td>
                                            <td>
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
                                            </td>
                                            <td>{{ number_format($order->total, 2) }} RSD</td>
                                            <td class="text-end">
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                                    Детаљи
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 