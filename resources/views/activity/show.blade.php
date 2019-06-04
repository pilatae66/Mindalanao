@extends('layouts.app')

@section('title')
    {{ $activity->activity_name }} Attendees
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bd-0 pb-4">
                        <div class="card-header tx-medium bd-0 tx-white bg-success d-flex justify-content-between">
                            <div class="pt-2">
                                    {{ $activity->activity_name }} Details
                            </div>
                            <div><a href="{{ route('activity.create') }}" class="btn btn-sm btn-success btn-rounded"><i class="icon ion-md-add"></i> Add New</a></div>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card bd-0">
                        <div class="card-header tx-medium bd-0 tx-white bg-success d-flex justify-content-between">
                            <div class="pt-2">
                                    {{ $activity->activity_name }} Attendees List
                            </div>
                            <div><a href="{{ route('activity.create') }}" class="btn btn-sm btn-success btn-rounded"><i class="icon ion-md-add"></i> Add New</a></div>
                        </div><!-- card-header -->
                        <div class="card-body bd bd-t-0">
                            <table class="table" id="activityDatatable">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Registered At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#activityDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('activity.attendees', $activity->id) !!}',
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },

                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'position' },
                    { data: 'department' },
                    { data: 'created_at' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

            $('#activityDatatable').on('click', '.delete[data-remote]',(e) => {
                e.preventDefault()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = e.currentTarget.dataset.remote;
                // console.log(e.currentTarget.dataset.remote)
                // confirm then
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _method: 'DELETE',
                            submit: true
                        }
                    }).always(function (data) {
                        $('#activityDatatable').DataTable().draw(false);
                    });
                }else alert("You have cancelled!"); })
            })
    </script>
@endpush
