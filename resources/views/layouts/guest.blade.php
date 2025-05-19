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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Custom CSS -->
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }
            .auth-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
            }
            .auth-box {
                background: white;
                border-radius: 15px;
                box-shadow: 0 0 40px rgba(0,0,0,0.1);
                padding: 2.5rem;
                width: 100%;
                max-width: 450px;
            }
            .auth-logo {
                text-align: center;
                margin-bottom: 2rem;
            }
            .auth-logo img {
                height: 60px;
            }
            .auth-title {
                font-size: 1.75rem;
                font-weight: 600;
                color: #2c3e50;
                text-align: center;
                margin-bottom: 2rem;
            }
            .form-control {
                border-radius: 8px;
                padding: 0.75rem 1rem;
                border: 1px solid #e2e8f0;
            }
            .form-control:focus {
                border-color: #4CAF50;
                box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
            }
            .btn-primary {
                background-color: #4CAF50;
                border-color: #4CAF50;
                border-radius: 8px;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
            }
            .btn-primary:hover {
                background-color: #388E3C;
                border-color: #388E3C;
            }
            .auth-links {
                text-align: center;
                margin-top: 1.5rem;
            }
            .auth-links a {
                color: #4CAF50;
                text-decoration: none;
            }
            .auth-links a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <div class="auth-box">
                <div class="auth-logo">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Masline Logo">
                    </a>
                </div>
                {{ $slot }}
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
