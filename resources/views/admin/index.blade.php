@extends('layouts.app')

@section('title')
    Admin
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-primary d-flex justify-content-between">
                    <div class="pt-2">
                        Admin List
                    </div>
                    <div><a href="{{ route('admin.create') }}" class="btn btn-sm btn-primary btn-rounded"><i class="icon ion-md-add"></i> Add New</a></div>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <table class="table compact" id="datatable">
                        <thead>
                            <tr>
                                <th>Employee Photo</th>
                                <th>Employee ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Date Employed</th>
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
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('admin.all') !!}',
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                columnDefs: [
                    {
                        targets: 0,
                        className: 'dt-body-center'
                    },
                    {
                        targets:[1,2,3,4,5,6,7,8],
                        className: 'align-middle'
                    }
                ],
                columns: [
                    { data: 'photo' },
                    { data: 'id' },
                    { data: 'username' },
                    { data: 'name', name:'firstname' },
                    { data: 'email' },
                    { data: 'position[0].position', name:'position.position' },
                    { data: 'department[0].department_name', name:'department.department_name' },
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
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
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
                            title: 'User has been successfully deleted!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                })
             })
        })
    </script>
@endpush
