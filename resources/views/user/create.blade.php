@extends('layouts.app')

@section('title')
    Users Create
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body bd bd-t-0">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="form-group">
                        <label>Firstname</label>
                        <input type="text" name="firstname" class="form-control @error('firstname') parsley-error @enderror" placeholder="Enter your firstname">
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
                        <label>Middlename</label>
                        <input type="text" name="middlename" class="form-control @error('middlename') parsley-error @enderror" placeholder="Enter your middlename">
                        @error('middlename')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
                        <label>Lastname</label>
                        <input type="text" name="lastname" class="form-control @error('lastname') parsley-error @enderror" placeholder="Enter your lastname">
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control @error('username') parsley-error @enderror" placeholder="Enter your username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control @error('email') parsley-error @enderror" placeholder="Enter your email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
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
                        </div><!-- form-group -->
                        <button class="btn btn-az-primary btn-block mb-2">Create Account</button>
                    </form>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#userDatatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('user.all') !!}',
                columns: [
                    { data: 'id' },
                    { data: 'username' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'created_at' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });
        })
    </script>
@endpush
