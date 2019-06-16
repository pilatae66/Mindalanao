@extends('layouts.app')

@section('title')
    Leave
@endsection

@section('content')
    @if (auth()->user()->role->first()->name == 'Admin')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white bg-primary d-flex justify-content-between">
                        <div class="pt-2">
                            Leave List
                        </div>
                        <div><a href="{{ route('leave.create') }}" class="btn btn-sm btn-primary btn-rounded"><i class="icon ion-md-add"></i> Add New</a></div>
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Leave Type</th>
                                    <th>Reason</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Filed by</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
    @endif
@endsection
@push('script')
    @if (auth()->user()->role->first()->name == 'Admin')
        <script>
            $(function() {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: '{!! route('leave.all') !!}',
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
                        { data: 'user.full_name', name:'user.firstname' },
                        { data: 'type.name' },
                        { data: 'reason' },
                        { data: 'start_date' },
                        { data: 'end_date' },
                        { data: 'admin.full_name', name:'user.firstname' },
                        { data: 'created_at' },
                        { data: 'action', orderable: false, searchable: false }
                    ]
                });

                $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

                $('#datatable').on('click', '.delete[data-remote]',(e) => {
                    e.preventDefault()
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var url = e.currentTarget.dataset.remote;
                    // console.log(e.currentTarget.dataset.remote)
                    // confirm then
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return axios.post(url, {
                                _method:"DELETE"
                            })
                            .then(response => {
                                console.log(response)
                                if (response.status == 403) {
                                    throw new Error(response)
                                }
                            })
                            .catch(error => {
                                if (error == "Error: Request failed with status code 403") {
                                    Swal.showValidationMessage(
                                        'Unauthorized'
                                    )
                                }
                            })
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    })
                    .then((result) => {
                        console.log(result)
                        if (result.value) {
                            $('#datatable').DataTable().draw(false);
                                swal.fire({
                                    position: 'top',
                                    toast: true,
                                    type: 'success',
                                    title: 'Leave has been successfully deleted!',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                        }
                    })
                })
            })
        </script>
    @endif
@endpush
