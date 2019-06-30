@extends('layouts.app')

@section('title')
    Users Create
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-body pd-40">
                <h5 class="card-title mg-b-20">Edit Employee</h5>
                    <form method="POST" action="{{ route('user.updateAdmin', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Position</label>
                                <select class="form-control select2-no-search @error('position') parsley-error @enderror" name="position">
                                    <option label="Choose one"></option>
                                    @foreach ($positions as $position)
                                        <option {{ $user->position->count() > 0 && $user->position[0]->id == $position->id ? "selected" : ""}} value="{{ $position->id }}">{{ $position->position }}</option>
                                    @endforeach
                                </select>
                                @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-6 pb-2">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Department</label>
                                <select class="form-control select2-no-search @error('department') parsley-error @enderror" name="department">
                                    <option label="Choose one"></option>
                                    @foreach ($departments as $department)
                                        <option {{ $user->department->count() > 0 && $user->department[0]->id == $department->id ? "selected" : ""}} value="{{ $department->id }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                        </div>
                        {{-- <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') parsley-error @enderror" placeholder="Enter your password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
                        <label>Verify Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Verify your password">
                        </div><!-- form-group --> --}}
                        <button class="btn btn-az-primary btn-block mb-2">Update</button>
                    </form>
            </div><!-- card -->
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#phoneMask').mask('+639999999999');

            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose one'
            });


            new Picker(document.querySelector('#datepicker'), {
                headers: true,
                format: 'MMMM DD, YYYY',
                text: {
                    title: 'Pick a Time',
                    year: 'Year',
                    month: 'Month',
                    day: 'Day'
                },
            });
        })


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imagePreview')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
