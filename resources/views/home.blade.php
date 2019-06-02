@extends('layouts.app')

@section('title')
    Hi, {{ auth()->user()->firstname }} welcome back!
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-indigo">
                    Description
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <p class="mg-b-0">Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet consictetur...</p>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection
