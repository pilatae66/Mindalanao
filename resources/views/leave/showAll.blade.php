@extends('layouts.app')

@section('title')
    Leave
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dashboard-seven">
                <div class="card-header tx-medium bd-0 tx-white bg-primary">
                    Leave Statistics
                </div><!-- card-header -->
                <div class="card-body">
                    <div class="row">
                        @forelse ($leavetypes as $types)
                            <div class="col-6 col-lg-3">
                                <label class="az-content-label">{{ $types->name }} Leave</label>
                                <h2>{{ $types->leaves->sum('number_of_days') }} days</h2>
                                <div class="desc up">
                                <i class="icon ion-md-stats"></i>
                                <span><strong>{{ round(($types->leaves->sum('number_of_days') / $types->days_allowed) * 100, 2) }}%</strong> ({{ $types->days_allowed - $types->leaves->sum('number_of_days') }} days remaining)</span>
                                </div>
                            </div><!-- col -->
                        @empty

                        @endforelse
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-primary d-flex justify-content-between">
                    Leave List
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <table class="table table-hover">
                        <thead>
                            <tr class="tx-center">
                                <th class="tx-bold">Leave Type</th>
                                <th class="tx-bold">Start Date</th>
                                <th class="tx-bold">End Date</th>
                                <th class="tx-bold">Number of Days</th>
                                <th class="tx-bold">Reason</th>
                                <th class="tx-bold">Confirmed by</th>
                                <th class="tx-bold">Date Filed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaves as $leave)
                                <tr class="tx-center">
                                    <td>{{ $leave->type->name }}</td>
                                    <td>{{ $leave->start_date }}</td>
                                    <td>{{ $leave->end_date }}</td>
                                    <td>{{ $leave->number_of_days }}</td>
                                    <td>{{ $leave->reason }}</td>
                                    <td>{{ $leave->admin->full_name }}</td>
                                    <td>{{ $leave->created_at->format('F d, Y') }}</td>
                                </tr>
                            @empty
                                <td>No Data Available</td>
                            @endforelse
                        </tbody>
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
