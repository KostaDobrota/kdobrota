@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Детаљи наруџбине #{{ $order->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Информације о наруџбини</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Број наруџбине:</th>
                                <td>#{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Купац:</th>
                                <td>{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Е-пошта:</th>
                                <td>{{ $order->user->email }}</td>
                            </tr>
                            <tr>
                                <th>Датум:</th>
                                <td>{{ $order->created_at->format('d.m.Y. H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Статус:</th>
                                <td>
                                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-control" onchange="this.form.submit()">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>На чекању</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>У обради</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Завршено</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Отказано</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th>Укупно:</th>
                                <td>{{ number_format($order->total, 2) }} RSD</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ставке наруџбине</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Производ</th>
                                    <th>Цена</th>
                                    <th>Количина</th>
                                    <th>Међузбир</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ number_format($item->price, 2) }} RSD</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price * $item->quantity, 2) }} RSD</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Укупно</th>
                                    <th>{{ number_format($order->total, 2) }} RSD</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Назад на наруџбине</a>
        </div>
    </div>
</div>
@endsection 