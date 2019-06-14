@extends('layouts.app')

@section('title')
    Leave Filling
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body pd-40">
                <h4 class="card-title mg-b-20 tx-center">Leave Filling Form</h4>
                    <form method="POST" action="{{ route('leave.update', $leave->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="employee_id" value="{{ auth()->user()->id }}">
                        <div class="form-group">
                        <label class="az-content-label tx-11 tx-medium tx-gray-600">Leave Type</label>
                        <select class="form-control select2-no-search @error('type') parsley-error @enderror" name="type" autofocus>
                            <option label="Choose one"></option>
                            <option {{ $leave->type == 'Maternity' ? 'selected' :  '' }} value="Maternity">Maternity</option>
                            <option {{  $leave->type == 'Paternity' ? 'selected' :  ''  }} value="Paternity">Paternity</option>
                            <option {{ $leave->type == 'Sick' ? 'selected' :  ''  }} value="Sick">Sick</option>
                            <option {{ $leave->type == 'Vacation' ? 'selected' :  ''  }} value="Vacation">Vacation</option>
                            <option {{ $leave->type == 'Emergency' ? 'selected' :  ''  }} value="Emergency">Emergency</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label class="az-content-label tx-11 tx-medium tx-gray-600">Start Date</label>
                            <input value="{{ $leave->start_date }}" type="text" name="start_date" class="form-control @error('start_date') parsley-error @enderror" placeholder="Click to select Start Date" required id="startdatepicker">
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label class="az-content-label tx-11 tx-medium tx-gray-600">End Date</label>
                            <input value="{{ $leave->end_date }}" type="text" name="end_date" class="form-control @error('end_date') parsley-error @enderror" placeholder="Click to select End Date" required id="enddatepicker">
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- form-group -->
                        <div class="form-group pb-2">
                            <label class="az-content-label tx-11 tx-medium tx-gray-600">Brief Reason</label>
                            <input value="{{ $leave->reason }}" type="text" name="reason" class="form-control @error('reason') parsley-error @enderror" placeholder="Enter a Brief Reason of your Leave" required>
                            @error('reason')
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
@push('script')
    <script>
        $(function(){
            new Picker(document.querySelector('#startdatepicker'), {
                headers: true,
                format: 'MMMM DD, YYYY',
                text: {
                    title: 'Pick a Time',
                    year: 'Year',
                    month: 'Month',
                    day: 'Day'
                },
            });

            new Picker(document.querySelector('#enddatepicker'), {
                headers: true,
                format: 'MMMM DD, YYYY',
                text: {
                    title: 'Pick a Time',
                    year: 'Year',
                    month: 'Month',
                    day: 'Day'
                },
            });
        })
    </script>
@endpush
