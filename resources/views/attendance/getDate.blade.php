@extends('layouts.app')

@section('title')
Employee Time Sheet
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body pd-40">
                <h3 class="card-title ml-auto mr-auto mb-5">Employee Time Sheet Validator</h3>
                <form action="{{ route('attendance.showHRODTR', $user->id) }}" method="post">
                    @csrf
                    <input type="text" value="{{ old('date') }}" name="date" class="form-control @error('date') parsley-error @enderror date" placeholder="Click to select date" id="datepicker">
                    <button type="submit" class="btn btn-success">View DTR</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            new Picker(document.querySelector('#datepicker'), {
                headers: true,
                format: 'MMMM DD YYYY',
                text: {
                    title: 'Pick a Month and Year',
                    year: 'Year',
                    day: 'Day',
                    month: 'Month',
                },
            });
        })
    </script>
@endpush
