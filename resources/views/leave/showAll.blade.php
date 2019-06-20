@extends('layouts.app')

@section('title')
    Activity
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-primary d-flex justify-content-between">
                    <div class="pt-2">
                        Activity List
                    </div>
                    <div><a href="{{ route('benefit.create') }}" class="btn btn-sm btn-primary btn-rounded"><i class="icon ion-md-add"></i> Add New</a></div>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="tx-bold">Name</div>
                                <div class="tx-bold">Provider</div>
                                <div class="tx-bold">Venue</div>
                                <div class="tx-bold">Date</div>
                                <div class="tx-bold">Time</div>
                                <div class="tx-bold">Description</div>
                                <div class="tx-bold">Date Created</div>
                            </div>
                        </li>
                        @forelse ($activities as $activity)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>{{ $activity->name }}</div>
                                    <div>{{ $activity->provider }}</div>
                                    <div>{{ $activity->venue }}</div>
                                    <div>{{ $activity->date }}</div>
                                    <div>{{ $activity->time }}</div>
                                    <div>{{ $activity->description }}</div>
                                    <div>{{ $activity->created_at->format('F d, Y') }}</div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item tx-center">No Data Available</li>
                        @endforelse
                    </ul>
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
