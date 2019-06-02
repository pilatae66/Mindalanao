@extends('layouts.app')

@section('title')
    Position Create
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body bd bd-t-0">
                    <form method="POST" action="{{ route('position.store') }}">
                        @csrf
                        <div class="form-group pb-2">
                        <label>Position</label>
                        <input type="text" name="position" class="form-control @error('position') parsley-error @enderror" placeholder="Enter position" required autofocus>
                        @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <button class="btn btn-az-primary btn-block mb-2">Create Account</button>
                    </form>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection
