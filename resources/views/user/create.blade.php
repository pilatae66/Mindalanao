@extends('layouts.app')

@section('title')
    Users Create
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body bd bd-t-0">
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 pb-3 d-flex justify-content-center ">
                                <img id="imagePreview" class="rounded-circle img-thumbnail " src="{{ asset('storage/photos/image.gif') }}" alt="your image" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pb-3">
                                <div class="custom-file">
                                    <input type="file" name="photoURL" class="custom-file-input" id="customFile" onchange="readURL(this);">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" value="{{ old('firstname') }}" name="firstname" class="form-control @error('firstname') parsley-error @enderror" placeholder="Enter your firstname">
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Middlename</label>
                                <input type="text" value="{{ old('middlename') }}" name="middlename" class="form-control @error('middlename') parsley-error @enderror" placeholder="Enter your middlename">
                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" value="{{ old('lastname') }}" name="lastname" class="form-control @error('lastname') parsley-error @enderror" placeholder="Enter your lastname">
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Username</label>
                                <input type="text" value="{{ old('username') }}" name="username" class="form-control @error('username') parsley-error @enderror" placeholder="Enter your username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control @error('email') parsley-error @enderror" placeholder="Enter your email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Address</label>
                                <input type="text" value="{{ old('address') }}" name="address" class="form-control @error('address') parsley-error @enderror" placeholder="Enter your address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Contact No.</label>
                                <input id="phoneMask" type="text" value="{{ old('contact_number') }}" name="contact_number" class="form-control @error('contact_number') parsley-error @enderror" placeholder="(+63) 900-000-0000">
                                @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control select2-no-search @error('gender') parsley-error @enderror" name="gender">
                                    <option label="Choose one"></option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="text" name="dob" class="form-control @error('dob') parsley-error @enderror" placeholder="Click to select date" id="datepicker">
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Position</label>
                                <select class="form-control select2-no-search @error('position') parsley-error @enderror" name="position">
                                    <option label="Choose one"></option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->position }}</option>
                                    @endforeach
                                </select>
                                @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Department</label>
                                <select class="form-control select2-no-search @error('department') parsley-error @enderror" name="department">
                                    <option label="Choose one"></option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
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
                        <div class="form-group">
                            <label>Degree</label>
                            <input type="text" name="degree" class="form-control @error('degree') parsley-error @enderror" placeholder="Enter Employee's Degree">
                            @error('degree')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- form-group -->
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
                        <button class="btn btn-az-primary btn-block mb-2">Create Employee</button>
                    </form>
                </div><!-- card-body -->
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
