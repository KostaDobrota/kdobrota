@extends('layouts.app')

@section('title', 'O nama - Masline')

@section('content')
    <!-- Hero Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">О нама</h1>
                    <p class="lead mb-4">Откријте причу о нашој страсти према маслинама и традицији која траје генерацијама.</p>
                    <a href="#contact" class="btn btn-success btn-lg">
                        <i class="fas fa-envelope me-2"></i>Контактирајте нас
                    </a>
                </div>
               
            </div>
        </div>
    </div>

    <!-- Story Section -->
    <div class="container py-5">
        <div class="row align-items-center g-5">
          
            <div class="col-lg-6">
                <span class="badge bg-success mb-3">Наша прича</span>
                <h2 class="h1 mb-4">Традиција и квалитет од 1995. године</h2>
                <p class="lead mb-4">Добродошли у Маслине - вашег поузданог партнера за најквалитетније маслине и маслиново уље из Херцеговине.</p>
                <p class="text-muted mb-4">Наша прича почиње 1995. године када смо одлучили да традиционалну производњу маслиновог уља претворимо у модерно пословање, задржавајући при томе све вредности и квалитет који су красили наше производе од самог почетка.</p>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-1">Природни производи</h3>
                                <p class="mb-0 small text-muted">100% природно, без додатака</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-award text-success"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-1">Награђивани квалитет</h3>
                                <p class="mb-0 small text-muted">Вишеструко награђивани</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-success mb-3">Наше вредности</span>
                <h2 class="h1 mb-4">Шта нас чини посебним</h2>
                <p class="lead text-muted mx-auto" style="max-width: 600px;">
                    Наше вредности су темељ нашег пословања и водиља у свему што радимо.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 mx-auto mb-4" style="width: fit-content;">
                                <i class="fas fa-heart text-success fa-2x"></i>
                            </div>
                            <h3 class="h4 mb-3">Страст</h3>
                            <p class="text-muted mb-0">Страст према квалитету и традицији води нас у свему што радимо. Сваки производ је резултат наше посвећености и љубави према послу.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 mx-auto mb-4" style="width: fit-content;">
                                <i class="fas fa-leaf text-success fa-2x"></i>
                            </div>
                            <h3 class="h4 mb-3">Одрживост</h3>
                            <p class="text-muted mb-0">Посвећени смо очувању природе и одрживој производњи. Наши процеси су еколошки прихватљиви и одговорni према околини.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle p-3 mx-auto mb-4" style="width: fit-content;">
                                <i class="fas fa-users text-success fa-2x"></i>
                            </div>
                            <h3 class="h4 mb-3">Заједница</h3>
                            <p class="text-muted mb-0">Подржавамо локалну заједницу и сарађујемо са локалним произвођачима. Заједно градимо бољу будућност за све.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card p-4">
                    <h3 class="display-4 fw-bold text-success mb-2">28+</h3>
                    <p class="text-muted mb-0">Година искуства</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card p-4">
                    <h3 class="display-4 fw-bold text-success mb-2">1000+</h3>
                    <p class="text-muted mb-0">Задовољних купаца</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card p-4">
                    <h3 class="display-4 fw-bold text-success mb-2">50+</h3>
                    <p class="text-muted mb-0">Производа</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card p-4">
                    <h3 class="display-4 fw-bold text-success mb-2">15+</h3>
                    <p class="text-muted mb-0">Награда</p>
                </div>
            </div>
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
        .hover-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .stat-card {
            border: 1px solid rgba(0,0,0,.125);
            border-radius: 0.5rem;
            transition: transform 0.2s ease-in-out;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection 