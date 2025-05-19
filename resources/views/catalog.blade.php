@extends('layouts.app')

@section('title', 'Proizvodi - Masline')

@section('content')
    <!-- Hero Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">Производи</h1>
                    <p class="lead text-muted mb-4">Откријте наш пажљиво одабрани асортиман маслина и маслиновог уља врхунског квалитета</p>
                </div>
                <div class="col-lg-4">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Претражите производе..." aria-label="Search products">
                        <button class="btn btn-success" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Filters Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm sticky-lg-top" style="top: 2rem;">
                    <div class="card-body">
                        <h3 class="h5 mb-4">Филтери</h3>
                        
                        <form action="{{ route('catalog') }}" method="GET" id="filterForm">
                            <!-- Categories -->
                            <div class="mb-4">
                                <h4 class="h6 mb-3 d-flex justify-content-between align-items-center">
                                    Категорије
                                    <button type="button" class="btn btn-link p-0 text-muted" onclick="clearCategories()">
                                        <small>Обриши</small>
                                    </button>
                                </h4>
                                @foreach($categories as $category)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" 
                                               name="categories[]" 
                                               value="{{ $category->id }}"
                                               id="category-{{ $category->id }}"
                                               {{ in_array($category->id, request()->get('categories', [])) ? 'checked' : '' }}
                                               onchange="this.form.submit()">
                                        <label class="form-check-label d-flex justify-content-between" for="category-{{ $category->id }}">
                                            {{ $category->name }}
                                            <span class="badge bg-light text-dark">{{ $category->products_count ?? 0 }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Price Range -->
                            <div class="mb-4">
                                <h4 class="h6 mb-3">Цена</h4>
                                <div class="range-slider">
                                    <input type="range" class="form-range" id="minPrice" name="min_price" 
                                           min="0" max="100" step="1" value="{{ request('min_price', 0) }}">
                                    <input type="range" class="form-range" id="maxPrice" name="max_price" 
                                           min="0" max="100" step="1" value="{{ request('max_price', 100) }}">
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="price-input">
                                        <span class="currency">€</span>
                                        <input type="number" id="minPriceInput" value="{{ request('min_price', 0) }}" min="0" max="100">
                                    </div>
                                    <span class="mx-2">-</span>
                                    <div class="price-input">
                                        <span class="currency">€</span>
                                        <input type="number" id="maxPriceInput" value="{{ request('max_price', 100) }}" min="0" max="100">
                                    </div>
                                </div>
                            </div>

                            <!-- Sort -->
                            <div class="mb-4">
                                <h4 class="h6 mb-3">Сортирај по</h4>
                                <select name="sort" class="form-select" onchange="this.form.submit()">
                                    <option value="recommended" {{ request('sort') == 'recommended' ? 'selected' : '' }}>Препоручено</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Цена: Најнижа прво</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Цена: Највиша прво</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Најновије</option>
                                </select>
                            </div>

                            <!-- Active Filters -->
                            @if(request()->anyFilled(['categories', 'min_price', 'max_price', 'sort']))
                                <div class="mt-4 pt-4 border-top">
                                    <h4 class="h6 mb-3 d-flex justify-content-between align-items-center">
                                        Активни филтери
                                        <a href="{{ route('catalog') }}" class="btn btn-link p-0 text-muted">
                                            <small>Обриши све</small>
                                        </a>
                                    </h4>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach(request()->get('categories', []) as $categoryId)
                                            @php $category = $categories->find($categoryId) @endphp
                                            @if($category)
                                                <span class="badge bg-success">
                                                    {{ $category->name }}
                                                    <button type="button" class="btn-close btn-close-white ms-2" 
                                                            onclick="removeCategory({{ $category->id }})"></button>
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                @if($products->isEmpty())
                    <div class="text-center py-5">
                        <img src="{{ asset('images/no-results.svg') }}" alt="No products found" class="img-fluid mb-4" style="max-width: 200px;">
                        <h2 class="h4 mb-3">Нема пронађених производа</h2>
                        <p class="text-muted mb-4">Покушајте да промените филтере или претрагу</p>
                        <a href="{{ route('catalog') }}" class="btn btn-outline-success">
                            <i class="fas fa-redo me-2"></i>Ресетуј филтере
                        </a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($products as $product)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm product-card">
                                    <div class="position-relative">
                                        @if($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('images/logo.png') }}" 
                                                 class="card-img-top" 
                                                 alt="Default Product Image">
                                        @endif
                                        @if($product->is_new)
                                            <span class="badge bg-success position-absolute top-0 end-0 m-3">Ново</span>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <span class="badge bg-light text-dark me-1">{{ $product->category->name }}</span>
                                        </div>
                                        <h3 class="h5 product-title mb-2">{{ $product->name }}</h3>
                                        <p class="text-muted small mb-3">{{ Str::limit($product->description, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 mb-0">{{ number_format($product->price, 2) }} RSD</span>
                                            <a href="{{ route('product.show', $product->slug) }}" 
                                               class="btn btn-outline-success">
                                                <i class="fas fa-eye me-1"></i> Детаљније
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .product-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .product-title {
            min-height: 48px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .page-link {
            color: #198754;
        }
        .page-item.active .page-link {
            background-color: #198754;
            border-color: #198754;
        }
        .range-slider {
            position: relative;
            margin-bottom: 1rem;
        }
        .price-input {
            position: relative;
            display: inline-flex;
            align-items: center;
        }
        .price-input input {
            width: 60px;
            padding: 0.25rem 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            margin-left: 0.25rem;
        }
        .currency {
            color: #6c757d;
        }
        .sticky-lg-top {
            z-index: 1000;
        }
    </style>

    <!-- Custom Scripts -->
    <script>
        function clearCategories() {
            document.querySelectorAll('input[name="categories[]"]').forEach(input => {
                input.checked = false;
            });
            document.getElementById('filterForm').submit();
        }

        function removeCategory(categoryId) {
            document.getElementById('category-' + categoryId).checked = false;
            document.getElementById('filterForm').submit();
        }

        // Price range slider functionality
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');
        const minPriceInput = document.getElementById('minPriceInput');
        const maxPriceInput = document.getElementById('maxPriceInput');

        function updatePriceInputs() {
            minPriceInput.value = minPrice.value;
            maxPriceInput.value = maxPrice.value;
        }

        function updatePriceSliders() {
            minPrice.value = minPriceInput.value;
            maxPrice.value = maxPriceInput.value;
        }

        minPrice.addEventListener('input', updatePriceInputs);
        maxPrice.addEventListener('input', updatePriceInputs);
        minPriceInput.addEventListener('change', updatePriceSliders);
        maxPriceInput.addEventListener('change', updatePriceSliders);

        // Submit form when price range changes
        [minPrice, maxPrice, minPriceInput, maxPriceInput].forEach(element => {
            element.addEventListener('change', () => {
                document.getElementById('filterForm').submit();
            });
        });
    </script>
@endsection 