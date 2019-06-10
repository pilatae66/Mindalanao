@extends('layouts.app')

@section('title')
    Activity
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-success d-flex justify-content-between">
                    <div class="pt-2">
                        Activity List
                    </div>
                    <div><a href="{{ route('activity.create') }}" class="btn btn-sm btn-success btn-rounded"><i class="icon ion-md-add"></i> Add New</a></div>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <table class="table" id="activityDatatable">
                        <thead>
                            <tr>
                                <th>Activity Name</th>
                                <th>Provider</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- card-body -->
            </div><!-- card -->
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
                ajax: '{!! route('activity.all') !!}',
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                columnDefs: [
                    {
                        targets:'_all',
                        className: 'align-middle'
                    }
                ],
                columns: [
                    { data: 'activity_name' },
                    { data: 'activity_provider' },
                    { data: 'activity_venue' },
                    { data: 'activity_date' },
                    { data: 'activity_time' },
                    { data: 'activity_description' },
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
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !swal.isLoading(),
                    preConfirm: () => {
                        return $.ajax({
                                    url: url,
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        _method: 'DELETE',
                                        submit: true
                                    }
                                }).catch(err => {
                                    console.log(err)
                                })
                    }
                    }).then((result) => {
                    if (result.value) {
                        $('#activityDatatable').DataTable().draw(false);
                        swal.fire({
                            position: 'top',
                            toast: true,
                            type: 'success',
                            title: 'Activity has been successfully deleted!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                })
             })
        })
    </script>
@endpush
