@extends('layouts.app')

@section('title')
    Payslip
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header tx-medium bd-0 tx-white bg-primary d-flex justify-content-between">
                    <h5 class="pt-2 card-title tx-white">
                        Payslip List for {{ $user->full_name }}
                    </h5>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0">
                    <div class="list-group">
                        <div class="d-flex list-group-item">
                            <div class="wd-50p tx-center tx-bold">Date</div>
                            <div class="wd-50p tx-center tx-bold">Net Salary</div>
                        </div>

                        @forelse ($payslips as $payslip)
                            <a href="{{ route('payslip.HRO', $payslip->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <div class="wd-50p tx-center">{{ $payslip->created_at->format('F d, Y') }}</div>
                                    <div class="wd-50p tx-center">₱{{ $payslip->net_salary }}</div>
                                </div>
                            </a>
                        @empty
                            <a class="list-group-item tx-center">No Data Available</a>
                        @endforelse
                    </div>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {

        })
    </script>
@endpush
