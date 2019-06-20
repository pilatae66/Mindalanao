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
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <div class="wd-lg-100p">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action d-flex justify-content-around">
                                <div class="tx-bold">Name</div>
                                <div class="tx-bold">Provider</div>
                                <div class="tx-bold">Venue</div>
                            </div>

                            @forelse ($activities as $activity)
                                <a href="{{ route('activity.show', $activity->id) }}" class="list-group-item list-group-item-action d-flex justify-content-around">
                                    <div>{{ $activity->activity_name }}</div>
                                    <div>{{ $activity->activity_provider }}</div>
                                    <div>{{ $activity->activity_venue }}</div>
                                </a>
                            @empty
                                <div class="list-group-item tx-center">No Data Available</div>
                            @endforelse
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">

                        </li>
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
