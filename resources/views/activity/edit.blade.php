@extends('layouts.app')

@section('title')
    Activity Edit
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-body pd-40">
                <h5 class="card-title mg-b-20">Edit Activity</h5>
                    <form method="POST" action="{{ route('activity.update', $activity->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Activity Name</label>
                                <input type="text" value="{{ $activity->activity_name }}" name="activity_name" class="form-control @error('activity_name') parsley-error @enderror" placeholder="Enter Department Name" required autofocus>
                                @error('activity_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Provider</label>
                                <input type="text" value="{{ $activity->activity_provider }}" name="activity_provider" class="form-control @error('activity_provider') parsley-error @enderror" placeholder="Enter Department Name" required autofocus>
                                @error('activity_provider')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Activity Date</label>
                                <input type="text" value="{{ $activity->activity_date }}" name="activity_date" class="form-control @error('activity_date') parsley-error @enderror" placeholder="Click to select date" required id="datepicker">
                                @error('activity_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Activity Time</label>

                                <input type="text" value="{{ $activity->activity_time }}" name="activity_time" id="timepicker" class="form-control @error('activty_time') parsley-error @enderror" placeholder="Click to select date" required>
                                @error('activty_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Activity Venue</label>
                                <input type="text" value="{{ $activity->activity_venue }}" name="activity_venue" class="form-control @error('activity_venue') parsley-error @enderror" placeholder="Enter Department Name" required autofocus>
                                @error('activity_venue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pb-2">
                                    <label class="az-content-label tx-11 tx-medium tx-gray-600">Activity Description</label>

                                    <textarea rows="5" name="activity_description" class="form-control @error('activity_description') parsley-error @enderror" placeholder="Enter Department Description" required autofocus>{{ $activity->activity_description }}</textarea>
                                    @error('activity_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-az-primary btn-block mb-2">Update</button>
                    </form>
            </div><!-- card -->
        </div>
    </div>
@endsection
