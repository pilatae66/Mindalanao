@extends('layouts.app')

@section('title')
    {{ $activity->activity_name }} Attendees
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card bd-0 pb-4">
                        <div class="card-header tx-medium bd-0 tx-white tx-light bg-primary d-flex justify-content-between">
                            <div class="pt-2">
                                    {{ $activity->activity_name }} Details
                            </div>
                            @can('signup', App\Activity::class)
                                <div>
                                    @if ($check)
                                    <button class="btn btn-sm btn-primary btn-rounded signup" disabled id="signup"><i class="icon ion-md-checkmark"></i> Signed up</button>
                                    @else
                                        <button class="btn btn-sm btn-primary btn-rounded signup" id="signup"><i class="icon ion-md-checkmark"></i> Sign me up</button>
                                    @endif
                                </div>
                            @endcan
                        </div><!-- card-header -->
                        <div class="card-body bd bd-t-0">
                            <div class="row pb-2">
                                <div class="col-md-6 tx-center"><h5 class="tx-danger">Activity: </h5><p>{{ $activity->activity_name }}</p></div>
                                <div class="col-md-6 tx-center"><h5 class="tx-danger">Provider: </h5><p>{{ $activity->activity_provider }}</p></div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-md-12 tx-center"><h5 class="tx-danger">Venue: </h5><p>{{ $activity->activity_venue }}</p></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pl-5"><h5 class="tx-danger">Description: </h5><p>{{ $activity->activity_description }}</p></div>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div>
            </div>
            @can('create', App\Activity::class)
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card bd-0">
                            <div class="card-header tx-medium bd-0 bg-primary tx-light tx-white d-flex justify-content-between">
                                <div class="pt-2">
                                        {{ $activity->activity_name }} Attendees List
                                </div>
                                <div>
                                    <a href="" class="btn btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#modaldemo1"><i class="icon ion-md-add"></i> Add Attendees</a>
                                </div>
                            </div><!-- card-header -->
                            <div class="card-body bd">
                                <attendee-table activity-id="{{ $activity->id }}" />
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
@section('modal')
<div id="modaldemo1" class="modal fade effect-sign">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header bg-primary">
                <h6 class="modal-title tx-white">Register Employee</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <attendee-modal activity-id="{{ $activity->id }}"></attendee-modal>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-indigo">Save changes</button>
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
@endsection
@push('script')
    <script>
        $(function(){
            $('#signup').on('click', function(e) {
                axios({
                    method: 'POST',
                    url: '{!! route('activity.addEmployeeToActivity') !!}',
                    data: {
                        activityId: {!! $activity->id !!},
                        employeeId: {!! auth()->user()->id !!}
                    }
                }).then(res => {
                    window.location = '{!! route('activity.show', $activity->id) !!}'
                }).catch(err => {
                    console.log(err)
                })
            })
        })

    </script>
@endpush
