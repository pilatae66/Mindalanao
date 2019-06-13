@extends('layouts.app')

@section('title')
    Position Edit
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body pd-40">
                <h5 class="card-title mg-b-20">Edit Position</h5>
                    <form method="POST" action="{{ route('position.update', $position->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                        <label class="az-content-label tx-11 tx-medium tx-gray-600">Position</label>
                        <input type="text" name="position" class="form-control @error('position') parsley-error @enderror" placeholder="Enter position" value="{{ $position->position }}" required autofocus>
                        @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                        <label class="az-content-label tx-11 tx-medium tx-gray-600">Department</label>
                        <select class="form-control select2-no-search @error('department') parsley-error @enderror" name="department">
                            <option label="Choose one"></option>
                            @foreach ($departments as $department)
                                <option {{ $position->department->contains($department->id) ? "selected" : "" }} value="{{ $department->id }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group pb-2">
                        <label class="az-content-label tx-11 tx-medium tx-gray-600">Basic Salary</label>
                        <input type="text" value="{{ old('salary') ?: $position->salary }}" name="salary" class="form-control @error('salary') parsley-error @enderror" placeholder="Enter salary" required autofocus>
                        @error('salary')
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
