@extends('layouts.app')

@section('title')
    Department Edit
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body bd bd-t-0">
                    <form method="POST" action="{{ route('department.update', $department->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group pb-2">
                        <label>Department</label>
                        <input type="text" name="department_name" class="form-control @error('department') parsley-error @enderror" placeholder="Enter department" value="{{ $department->department_name }}" required autofocus>
                        @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <button class="btn btn-az-primary btn-block mb-2">Update Department</button>
                    </form>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection
