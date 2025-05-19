<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Masline'))</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Animate.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <!-- Custom CSS -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <style>
            /* Footer Styles */
            .footer {
                background-color: #2c3e50;
                color: #ecf0f1;
                padding: 4rem 0 2rem;
            }
            
            .footer h5 {
                color: #3498db;
                margin-bottom: 1.5rem;
                font-weight: 600;
            }
            
            .footer-links {
                list-style: none;
                padding: 0;
            }
            
            .footer-links li {
                margin-bottom: 0.75rem;
            }
            
            .footer-links a {
                color: #ecf0f1;
                text-decoration: none;
                transition: color 0.3s ease;
            }
            
            .footer-links a:hover {
                color: #3498db;
            }
            
            .footer-social a {
                color: #ecf0f1;
                margin-right: 1rem;
                font-size: 1.5rem;
                transition: color 0.3s ease;
            }
            
            .footer-social a:hover {
                color: #3498db;
            }
            
            .footer-bottom {
                border-top: 1px solid rgba(236, 240, 241, 0.1);
                padding-top: 2rem;
                margin-top: 3rem;
            }
        </style>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
        @vite(['resources/js/app.js'])
        
        <!-- TinyMCE -->
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        @stack('styles')
    </head>
    <body>
        <div class="min-vh-100 d-flex flex-column">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm">
                    <div class="container py-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow-1">
                @yield('content')

                <!-- Footer -->
                <footer class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <h5>O nama</h5>
                                <p>Najbolje masline i maslinovo ulje iz Hercegovine. Tradicija, kvalitet i pouzdanost na jednom mestu.</p>
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 mb-4">
                                <h5>Brzi linkovi</h5>
                                <ul class="footer-links">
                                    <li><a href="{{ route('home') }}">Početna</a></li>
                                    <li><a href="{{ route('catalog') }}">Proizvodi</a></li>
                                    <li><a href="{{ route('about') }}">O nama</a></li>
                                    <li><a href="{{ route('contact') }}">Kontakt</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5>Kategorije</h5>
                                <ul class="footer-links">
                                    <li><a href="#">Maslinovo ulje</a></li>
                                    <li><a href="#">Masline</a></li>
                                    <li><a href="#">Poklon paketi</a></li>
                                    <li><a href="#">Dodaci</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <h5>Kontakt</h5>
                                <ul class="footer-links">
                                    <li><i class="fas fa-map-marker-alt me-2"></i> Belgrade</li>
                                    <li><i class="fas fa-phone me-2"></i> +387 65 123 456</li>
                                    <li><i class="fas fa-envelope me-2"></i> info@masline.com</li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-bottom text-center">
                            <p class="mb-0">Kdobrota - Broj indeksa 5823IT</p>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
