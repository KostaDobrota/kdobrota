@extends('layouts.app')

@section('title', 'Моје наруџбине - Masline')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">Моје наруџбине</h1>

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-box-open text-muted" style="font-size: 5rem;"></i>
            <h2 class="h4 mt-4">Немате наруџбина</h2>
            <p class="text-muted mb-4">Погледајте наше производе и направите своју прву наруџбину</p>
            <a href="{{ route('catalog') }}" class="btn btn-success">
                <i class="fas fa-shopping-cart me-2"></i>Погледајте производе
            </a>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4 py-3">Број наруџбине</th>
                                <th class="border-0 px-4 py-3">Датум</th>
                                <th class="border-0 px-4 py-3">Статус</th>
                                <th class="border-0 px-4 py-3">Укупно</th>
                                <th class="border-0 px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="px-4 py-3">#{{ $order->id }}</td>
                                    <td class="px-4 py-3">{{ $order->created_at->format('d.m.Y.') }}</td>
                                    <td class="px-4 py-3">
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
                                    <td class="px-4 py-3">{{ number_format($order->total, 2) }} RSD</td>
                                    <td class="px-4 py-3 text-end">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                            Детаљи
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
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection 