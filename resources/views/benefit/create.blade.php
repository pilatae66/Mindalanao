@extends('layouts.app')

@section('title')
    Benefit Create
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body pd-40">
                <h5 class="card-title mg-b-20">Create Benefit</h5>
                    <form method="POST" action="{{ route('benefit.store') }}">
                        @csrf
                        <div class="form-group pb-2">
                        <label class="az-content-label tx-11 tx-medium tx-gray-600">Benefit Name</label>
                        <input type="text" name="name" class="form-control @error('name') parsley-error @enderror" placeholder="Enter Deduction Name" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label class="az-content-label tx-11 tx-medium tx-gray-600">Deduction Amount</label>
                            <input type="number" name="amount" class="form-control @error('amount') parsley-error @enderror" placeholder="Enter Deduction Amount" required autofocus>
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- form-group -->
                        <button class="btn btn-az-primary btn-block mb-2">Create</button>
                    </form>
            </div><!-- card -->
        </div>
    </div>
@endsection
