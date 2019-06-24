@extends('layouts.app')

@section('title')
    Admin Edit
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-body pd-40">
                <h5 class="card-title mg-b-20 tx-center">Edit Admin</h5>
                    <form method="POST" action="{{ route('admin.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 pb-3 d-flex justify-content-center ">
                                <img id="imagePreview" class="rounded-circle img-thumbnail " src="{{ asset($user->photoURL ?: 'storage/photos/image.gif') }}" alt="your image" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pb-3">
                                <div class="custom-file">
                                    <input type="file" name="photoURL" class="custom-file-input @error('photoURL') parsley-error @enderror" id="customFile" onchange="readURL(this);">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    @error('photoURL')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Firstname</label>
                                <input type="text" value="{{ $user->firstname }}" name="firstname" class="form-control @error('firstname') parsley-error @enderror" placeholder="Enter your firstname" autofocus>
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Middlename</label>
                                <input type="text" value="{{ $user->middlename }}" name="middlename" class="form-control @error('middlename') parsley-error @enderror" placeholder="Enter your middlename">
                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Lastname</label>
                                <input type="text" value="{{ $user->lastname }}" name="lastname" class="form-control @error('lastname') parsley-error @enderror" placeholder="Enter your lastname">
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
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Username</label>
                                <input type="text" value="{{ $user->username }}" name="username" class="form-control @error('username') parsley-error @enderror" placeholder="Enter your username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Email</label>
                                <input type="email" value="{{ $user->email }}" name="email" class="form-control @error('email') parsley-error @enderror" placeholder="Enter your email">
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
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Address</label>
                                <input type="text" value="{{ $user->address }}" name="address" class="form-control @error('address') parsley-error @enderror" placeholder="Enter your address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Contact No.</label>
                                <input id="phoneMask" type="text" value="{{ $user->contact_number }}" name="contact_number" class="form-control @error('contact_number') parsley-error @enderror" placeholder="(+63) 900-000-0000">
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
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Gender</label>
                                <select class="form-control select2-no-search @error('gender') parsley-error @enderror" name="gender">
                                    <option label="Choose one"></option>
                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- form-group -->
                            </div>
                            <input type="hidden" name="role" value="{{ $user->role }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Date of Birth</label>
                                <input type="text" value="{{ $user->dob }}" name="dob" class="form-control @error('dob') parsley-error @enderror" placeholder="Click to select date" id="datepicker">
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
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Position</label>
                                <select class="form-control select2-no-search @error('position') parsley-error @enderror" name="position">
                                    <option label="Choose one"></option>
                                    @foreach ($positions as $position)
                                        <option {{ $user->position[0]->position == $position->position ? 'selected' : '' }} value="{{ $position->id }}">{{ $position->position }}</option>
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
                                <label class="az-content-label tx-11 tx-medium tx-gray-600">Department</label>
                                <select class="form-control select2-no-search @error('department') parsley-error @enderror" name="department">
                                    <option label="Choose one"></option>
                                    @foreach ($departments as $department)
                                        <option {{ $user->department[0]->department_name == $department->department_name ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->department_name }}</option>
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
                        <div class="form-group pb-2">
                            <label class="az-content-label tx-11 tx-medium tx-gray-600">Degree</label>
                            <input type="text" value="{{ $user->degree }}" name="degree" class="form-control @error('degree') parsley-error @enderror" placeholder="Enter Employee's Degree">
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
                        <button class="btn btn-az-primary btn-block">Update</button>
                    </form>
            </div><!-- card -->
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#phoneMask').mask('+639999999999');

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
