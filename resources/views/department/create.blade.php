@extends('layouts.app')

@section('title')
    Department Create
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body bd-t-0">
                    <form method="POST" action="{{ route('department.store') }}">
                        @csrf
                        <div class="form-group pb-2">
                        <label>Department Name</label>
                        <input type="text" name="department_name" class="form-control @error('department') parsley-error @enderror" placeholder="Enter Department Name" required autofocus>
                        @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label>Parent Department</label>
                            <select class="form-control select2-no-search @error('parent_department_id') parsley-error @enderror" name="parent_department_id">
                                <option label="Choose one"></option>
                                <option value="null">None</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                            @error('parent_department_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- form-group -->
                        <button class="btn btn-az-primary btn-block mb-2">Create Department</button>
                    </form>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection
