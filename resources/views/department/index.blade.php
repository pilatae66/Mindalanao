@extends('layouts.app')

@section('title')
    Department
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-success d-flex justify-content-between">
                    <div class="pt-2">
                        Department List
                    </div>
                    <div><a href="{{ route('department.create') }}" class="btn btn-sm btn-success btn-rounded"><i class="icon ion-md-add"></i> Add New</a></div>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <table class="table" id="departmentDatatable">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Parent Department</th>
                                <th>Members</th>
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
            $('#departmentDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('department.all') !!}',
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
                    { data: 'department_name' },
                    { data: 'parent' },
                    { data: 'employees' },
                    { data: 'created_at' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

            $('#departmentDatatable').on('click', '.delete[data-remote]',(e) => {
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
                        $('#departmentDatatable').DataTable().draw(false);
                    });
                }else alert("You have cancelled!"); })
            })
    </script>
@endpush
