@extends('layouts.app')

@section('title')
    Users
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-success d-flex justify-content-between">
                    <div class="pt-2">
                        User List
                    </div>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <table class="table" id="userDatatable">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
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
            $('#userDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('user.all') !!}',
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },

                columns: [
                    { data: 'id' },
                    { data: 'username' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'created_at' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

            $('#userDatatable').on('click', '.delete[data-remote]',(e) => {
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
                        $('#userDatatable').DataTable().draw(false);
                    });
                }else alert("You have cancelled!"); })
            })
    </script>
@endpush
