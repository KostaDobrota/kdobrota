@extends('layouts.app')

@section('title', 'Мој профил - Masline')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">Мој профил</h1>

    <div class="row g-4">
        <!-- Orders Summary Card -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Укупно наруџбина</h6>
                            <h2 class="mb-0 text-dark">{{ $user->orders()->count() }}</h2>
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
                            <h6 class="text-uppercase text-muted mb-2">Лични подаци</h6>
                            <h5 class="mb-0 text-dark">{{ $user->name }}</h5>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                        <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    </div>
                    
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Измени податке
                    </button>
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

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Измени профил</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Име и презиме</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Емаил адреса</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Тренутна лозинка</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <small class="text-muted">Оставите празно ако не желите да промените лозинку</small>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Нова лозинка</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Потврда нове лозинке</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Откажи</button>
                    <button type="submit" class="btn btn-primary">Сачувај измене</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 