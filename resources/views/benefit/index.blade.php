@extends('layouts.app')

@section('title')
    Benefits
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-primary d-flex justify-content-between">
                    <div class="pt-2">
                        Benefit List
                    </div>
                    <div>
                        <a href="{{ route('benefit.create') }}" class="btn btn-sm btn-primary btn-rounded">
                            <i class="icon ion-md-add"></i> Add New
                        </a>
                        <a href="{{ route('print.benefit') }}" class="btn btn-sm btn-primary btn-rounded" data-toggle="tooltip" data-placement="top" title="Print Benefit Master List'">
                            <i class="icon ion-md-print"></i> Print
                        </a>
                    </div>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Effectivity Date</th>
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
                ajax: '{!! route('benefit.all') !!}',
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
                    { data: 'name' },
                    { data: 'amount' },
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
                        $('#datatable').DataTable().draw(false);
                        swal.fire({
                            position: 'top',
                            toast: true,
                            type: 'success',
                            title: 'Benefit has been successfully deleted!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                })
            })
        })
    </script>
@endpush
