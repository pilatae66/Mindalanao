@extends('layouts.app')
{{--
@section('title')
    Hi, {{ auth()->user()->firstname }} welcome back!
@endsection --}}

@section('content')
    <div class="p-0 m-0 row justify-content-center">
        <div class="col-md-10">
                <div class="wd-lg-100p">
                        <div id="carouselExample5" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExample5" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExample5" data-slide-to="1"></li>
                            <li data-target="#carouselExample5" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner bg-light">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/photos/nosTEAM.bmp') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="../img/img12.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="../img/img13.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample5" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"><i data-feather="chevron-left"></i></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample5" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"><i data-feather="chevron-right"></i></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
        </div>
    </div>
@endsection
