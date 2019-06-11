@extends('layouts.app')

@section('title')
    Position Create
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body bd-t-0">
                    <form method="POST" action="{{ route('position.store') }}">
                        @csrf
                        <div class="form-group">
                        <label>Position</label>
                        <input type="text" value="{{ old('position') }}" name="position" class="form-control @error('position') parsley-error @enderror" placeholder="Enter position" required autofocus>
                        @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
                        <label>Department</label>
                        <select class="form-control select2-no-search @error('department') parsley-error @enderror" name="department">
                            <option label="Choose one"></option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group pb-2">
                        <label>Basic Salary</label>
                        <input type="number" value="{{ old('salary') }}" name="salary" class="form-control @error('salary') parsley-error @enderror" placeholder="Enter salary" required autofocus>
                        @error('salary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <button class="btn btn-az-primary btn-block mb-2">Create Position</button>
                    </form>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function(){

        })
    </script>
@endpush
