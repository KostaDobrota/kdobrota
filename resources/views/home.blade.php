@extends('layouts.app')

@section('title', 'Masline - Najbolje masline i maslinovo ulje iz Dalmacije')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative d-flex align-items-center">
        <div class="hero-bg-overlay"></div>
        <div class="container position-relative py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="display-5 text-white fw-bold mb-3 animate__animated animate__fadeInUp">
                        Najbolje masline i maslinovo ulje iz Dalmacije
                    </h1>
                    <p class="lead text-white mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        Otkrijte vrhunski kvalitet naših proizvoda direktno iz srca Dalmacije. 
                        Tradicionalna proizvodnja, moderna dostava.
                    </p>
                    <div class="d-flex gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="{{ route('catalog') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-basket me-2"></i>Pregledaj katalog
                        </a>
                        <a href="{{ route('about') }}" class="btn btn-outline-light">
                            <i class="fas fa-info-circle me-2"></i>Saznaj više
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator animate__animated animate__fadeIn animate__delay-2s">
            <a href="#featured-products" class="text-white">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured-products" class="featured-products py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary text-uppercase fw-bold mb-2">Izdvajamo iz ponude</h6>
                <h2 class="display-5 fw-bold mb-4">Najpopularniji proizvodi</h2>
                <p class="lead text-muted">Otkrijte zašto su ovi proizvodi omiljeni među našim kupcima</p>
            </div>
            
            @if($featuredProducts->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <p class="lead text-muted">Trenutno nema istaknutih proizvoda.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($featuredProducts as $product)
                        <div class="col-md-6 col-lg-3">
                            <div class="product-card h-100">
                                <div class="product-image position-relative">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid">
                                    @else
                                        <img src="{{ asset('images/logo.png') }}" 
                                             alt="Default Product Image" 
                                             class="img-fluid">
                                    @endif
                                    <div class="product-actions">
                                        <button class="btn btn-light btn-sm" title="Dodaj u korpu">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="btn btn-light btn-sm" title="Dodaj u favorite">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="product-content p-4">
                                    <h3 class="h5 mb-2">{{ $product->name }}</h3>
                                    <p class="text-muted mb-3">{{ Str::limit($product->description, 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="product-price">{{ number_format($product->price, 2) }} €</span>
                                        <a href="{{ route('product.show', $product->slug) }}" 
                                           class="btn btn-outline-primary btn-sm">Detaljnije</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('catalog') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-th-large me-2"></i>Pogledaj sve proizvode
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-us py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary text-uppercase fw-bold mb-2">Naše prednosti</h6>
                <h2 class="display-5 fw-bold mb-4">Zašto odabrati nas?</h2>
                <p class="lead text-muted">Otkrijte šta nas čini posebnim i zašto nam kupci veruju</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-award fa-3x text-primary"></i>
                        </div>
                        <h3 class="h5 mb-3">Vrhunski kvalitet</h3>
                        <p class="text-muted mb-0">Samo najbolje masline i maslinovo ulje iz Hercegovine</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-truck fa-3x text-primary"></i>
                        </div>
                        <h3 class="h5 mb-3">Brza dostava</h3>
                        <p class="text-muted mb-0">Dostava na vašu adresu u najkraćem roku</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-hand-holding-usd fa-3x text-primary"></i>
                        </div>
                        <h3 class="h5 mb-3">Fer cene</h3>
                        <p class="text-muted mb-0">Najbolji odnos cene i kvaliteta na tržištu</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h3 class="h5 mb-3">24/7 Podrška</h3>
                        <p class="text-muted mb-0">Tu smo za vas u bilo koje vreme</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-6 fw-bold mb-4">Budite u toku sa nama</h2>
                    <p class="lead mb-5">Prijavite se na naš newsletter i budite prvi koji će saznati za nove proizvode, akcije i savete.</p>
                    <form class="newsletter-form">
                        <div class="row justify-content-center g-2">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="Vaša email adresa">
                                    <button class="btn btn-light btn-lg" type="submit">
                                        <i class="fas fa-paper-plane me-2"></i>Prijavi se
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), 
                    url('{{ asset('images/hero-bg.jpg') }}') no-repeat center center;
        background-size: cover;
        position: relative;
        overflow: hidden;
        min-height: 500px;
        max-height: 600px;
    }

    .hero-bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .hero-content {
        z-index: 1;
    }

    .hero-image {
        filter: drop-shadow(0 0 20px rgba(0, 0, 0, 0.3));
        transform-origin: center center;
        animation: float 6s ease-in-out infinite;
        max-height: 400px;
        width: auto;
    }

    .hero-scroll-indicator {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
    }

    .hero-scroll-indicator a {
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .hero-scroll-indicator a:hover {
        opacity: 1;
        transform: translateY(-5px);
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .hero-section {
            min-height: 400px;
            padding: 4rem 0;
        }

        .hero-content {
            text-align: center;
        }

        .hero-content .d-flex {
            justify-content: center;
        }

        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content .lead {
            font-size: 1.1rem;
        }
    }

    /* Product Cards */
    .product-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-10px);
    }

    .product-image {
        height: 250px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .placeholder-image {
        height: 100%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        gap: 5px;
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.3s ease;
    }

    .product-card:hover .product-actions {
        opacity: 1;
        transform: translateX(0);
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--bs-primary);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></script>
<script>
    // Smooth scroll for hero section indicator
    document.querySelector('.hero-scroll-indicator a').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });

    // Initialize animations
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', entry.target.dataset.animation);
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('[data-animation]').forEach((element) => {
            observer.observe(element);
        });
    });
</script>
@endpush 