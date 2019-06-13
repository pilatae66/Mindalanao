@extends('layouts.app')

@section('title')
    Department Edit
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body pd-40">
                <h5 class="card-title mg-b-20">Edit Department</h5>
                    <form method="POST" action="{{ route('department.update', $department->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="az-content-label tx-11 tx-medium tx-gray-600">Department</label>
                            <input type="text" name="department_name" class="form-control @error('department') parsley-error @enderror" placeholder="Enter department" value="{{ $department->department_name }}" required autofocus>
                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group pb-2">
                            <label class="az-content-label tx-11 tx-medium tx-gray-600">Parent Department</label>
                            <select class="form-control select2-no-search @error('parent_department_id') parsley-error @enderror" name="parent_department_id">
                                <option label="Choose one"></option>
                                <option {{ $department->parent_department_id == null ? 'selected' : '' }} value="null">None</option>
                                @foreach ($departments as $department1)
                                    <option {{ $department1->id == $department->parent_department_id ? 'selected' : '' }} value="{{ $department1->id }}">{{ $department1->department_name }}</option>
                                @endforeach
                            </select>
                            @error('parent_department_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- form-group -->
                        <button class="btn btn-az-primary btn-block mb-2">Update</button>
                    </form>
            </div><!-- card -->
        </div>
    </div>
@endsection
