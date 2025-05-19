@extends('layouts.app')

@section('title', 'Kontakt - Masline')

@section('content')
    <!-- Hero Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Контактирајте нас</h1>
                    <p class="lead mb-4">Имате питање или желите да сарађујемо? Контактирајте нас и одговорићемо вам у најкраћем року.</p>
                    <div class="d-flex gap-3">
                        <a href="tel:+38761234567" class="btn btn-success btn-lg">
                            <i class="fas fa-phone me-2"></i>Позовите нас
                        </a>
                        <a href="#contact-form" class="btn btn-outline-success btn-lg">
                            <i class="fas fa-envelope me-2"></i>Пошаљите поруку
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/contact-hero.jpg') }}" alt="Contact Hero" class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="sticky-lg-top" style="top: 2rem;">
                    <h2 class="h3 mb-4">Информације за контакт</h2>
                    
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-map-marker-alt text-success"></i>
                                </div>
                                <div>
                                    <h3 class="h6 mb-1">Адреса</h3>
                                    <p class="mb-0">Центар Београда<br>Из Далмације</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-phone text-success"></i>
                                </div>
                                <div>
                                    <h3 class="h6 mb-1">Телефон</h3>
                                    <p class="mb-0">
                                        <a href="tel:+38761234567" class="text-decoration-none text-dark">
                                            +387 61 234 567
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-envelope text-success"></i>
                                </div>
                                <div>
                                    <h3 class="h6 mb-1">Email</h3>
                                    <p class="mb-0">
                                        <a href="mailto:info@masline.ba" class="text-decoration-none text-dark">
                                            info@masline.ba
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-clock text-success"></i>
                                </div>
                                <div>
                                    <h3 class="h6 mb-1">Радно време</h3>
                                    <p class="mb-0">
                                        Пон - Суб: 08:00 - 20:00<br>
                                        Недеља: Затворено
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="h6 mb-3">Пратите нас</h3>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-success btn-sm">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 mb-4" id="contact-form">Пошаљите нам поруку</h2>
                        <form class="needs-validation" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" placeholder="Име и презиме" required>
                                        <label for="name">Име и презиме</label>
                                        <div class="invalid-feedback">
                                            Молимо унесите ваше име и презиме.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" placeholder="Email адреса" required>
                                        <label for="email">Email адреса</label>
                                        <div class="invalid-feedback">
                                            Молимо унесите валидну email адресу.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="subject" placeholder="Наслов" required>
                                        <label for="subject">Наслов</label>
                                        <div class="invalid-feedback">
                                            Молимо унесите наслов поруке.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="message" placeholder="Порука" style="height: 150px" required></textarea>
                                        <label for="message">Порука</label>
                                        <div class="invalid-feedback">
                                            Молимо унесите вашу поруку.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="privacy" required>
                                        <label class="form-check-label" for="privacy">
                                            Слажем се са <a href="#" class="text-success">политиком приватности</a>
                                        </label>
                                        <div class="invalid-feedback">
                                            Морате се сложити са политиком приватности.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Пошаљи поруку
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="container-fluid px-0">
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11322.245281487436!2d20.45976277068731!3d44.81558977107547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7ab25c703261%3A0x364a6418c2647da9!2z0JHQtdC-0LPRgNCw0LQg0KbQtdC90YLQsNGA!5e0!3m2!1ssr!2srs!4v1710799167444!5m2!1ssr!2srs" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .map-container {
            position: relative;
            overflow: hidden;
            padding-top: 450px;
        }
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #198754;
        }
        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }
    </style>

    <!-- Form Validation Script -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection 