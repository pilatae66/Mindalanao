@extends('layouts.app')

@section('title')
    Leave Type Create
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body pd-40">
                <h5 class="card-title mg-b-20 tx-center">Create Leave Type</h5>
                    <form method="POST" action="{{ route('leaveType.store') }}">
                        @csrf
                        <div class="form-group pb-2">
                        <label class="az-content-label tx-11 tx-medium tx-gray-600">Leave Type Name</label>
                        <input type="text" name="name" class="form-control @error('name') parsley-error @enderror" placeholder="Enter Leave Type Name" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group pb-2">
                            <label class="az-content-label tx-11 tx-medium tx-gray-600">Maximum Days of Leave</label>
                            <input type="number" name="days_allowed" class="form-control @error('days_allowed') parsley-error @enderror" placeholder="Enter Number Maximum Days of Leave" required autofocus>
                            @error('days_allowed')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- form-group -->
                        <button class="btn btn-az-primary btn-block">Create</button>
                    </form>
            </div><!-- card -->
        </div>
    </div>
@endsection
