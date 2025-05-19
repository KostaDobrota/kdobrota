@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 text-dark mb-0">Производи</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Контролна табла</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Производи</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Додај нови производ
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">Products List</h5>
                </div>
                <div class="col-auto">
                    <div class="input-group" style="width: 300px;">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search products...">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="productsTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 ps-3">Производ</th>
                            <th class="border-0">Категорија</th>
                            <th class="border-0">Цена</th>
                            <th class="border-0">Залиха</th>
                            <th class="border-0">Статус</th>
                            <th class="border-0 text-end pe-3">Акције</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center">
                                    <div class="product-img me-3">
                                        @if($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" 
                                                 class="rounded" width="48" height="48" style="object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/logo.png') }}" 
                                                 alt="Default Product Image" 
                                                 class="rounded" width="48" height="48" style="object-fit: cover;">
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $product->name }}</h6>
                                        <small class="text-muted">Шифра: {{ $product->sku ?? 'Није унето' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold">{{ number_format($product->price, 2) }} RSD</span>
                            </td>
                            <td>
                                @if($product->stock > 10)
                                    <span class="text-success">
                                        <i class="fas fa-check-circle me-1"></i>{{ $product->stock }}
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="text-warning">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $product->stock }}
                                    </span>
                                @else
                                    <span class="text-danger">
                                        <i class="fas fa-times-circle me-1"></i>Нема на стању
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($product->featured)
                                    <span class="badge bg-warning">Истакнуто</span>
                                @else
                                    <span class="badge bg-secondary">Стандардно</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-edit me-1"></i>Измени
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Да ли сте сигурни да желите да обришете овај производ?')">
                                        <i class="fas fa-trash-alt me-1"></i>Обриши
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.placeholder-img {
    background-color: #f8f9fa;
}

#searchInput:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
}
</style>

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#productsTable').DataTable({
        "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rtip',
        "pageLength": 10,
        "ordering": true,
        "responsive": true,
        "language": {
            "search": "",
            "searchPlaceholder": "Претражи производе..."
        }
    });

    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });
});
</script>
@endpush

@endsection 