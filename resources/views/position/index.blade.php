@extends('layouts.app')

@section('title')
    Positions
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-primary d-flex justify-content-between">
                    <div class="pt-2">
                        Position List
                    </div>
                    <div><a href="{{ route('position.create') }}" class="btn btn-sm btn-primary btn-rounded"><i class="icon ion-md-add"></i> Add New</a></div>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Basic Salary</th>
                                <th>Total Members</th>
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
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('position.all') !!}',
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
                    { data: 'position' },
                    { data: 'department[0].department_name', name:'department.department_name' },
                    { data: 'salary' },
                    { data: 'users' },
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
                })
                let users
                let filteredUsers
                // axios.get('/getUserData').then(res => {
                //     users = res.data.data
                //     filteredUsers = users.filter(user => {
                //         return user.position == 'No Position'
                //     })
                //     // console.log(filteredUsers)
                // })
                var url = e.currentTarget.dataset.remote;
                console.log(e.currentTarget.dataset.remote)
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
                    }).catch(err=> console.log(err))
                    }
                    }).then((result) => {
                    if (result.value) {
                        $('#datatable').DataTable().draw(false);
                       swal.fire({
                            position: 'top',
                            toast: true,
                            type: 'success',
                            title: 'Position Successfully Deleted!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                })
             })
        })
    </script>
@endpush
