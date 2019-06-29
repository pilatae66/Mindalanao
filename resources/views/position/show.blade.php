@extends('layouts.app')

@section('title')
    {{ $position->position }} Members
@endsection

@section('content')
<div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bd-0">
                <div class="card-header bd bg-white">
                    <a href="{{ route('print.positionMembers', $position->id) }}" class="btn tx-primary bg-white btn-rounded float-right" data-toggle="tooltip" data-placement="top" title="Print Position Master List'">
                        <i class="icon ion-md-print"></i> Print
                    </a>
                </div>
                <div class="card-body bd bd-t-0">
                    <div class="row tx-center bd mb-3 p-3 rounded-5" style="margin-left: 2px; margin-right:2px;">
                        <div class="col-md-6">
                            <label style="color:blue;" for="name"><b>Position Name:</b></label>
                            <p>{{ $position->position }} </p>
                        </div>
                        <div class="col-md-6">
                            <label style="color:blue;" for="name"><b>Total Members:</b></label>
                            <p>{{ $position->users->count() }}</p>
                        </div>
                    </div>
                    <ul class="list-group" id="userList">
                        <input class="form-control list-group-item" onkeyup="searchList()" type="text" id="search" placeholder="Search...">
                        @forelse ($position->users as $user)
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset(!empty($user->photoURL) ? "storage/{$user->photoURL}" : 'storage/photos/image.gif' ) }}" class="wd-30 rounded-circle mg-r-15" alt="">
                                    <div class="">
                                        <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">{{ $user->full_name }}</h6>
                                        <span class="d-block tx-11 text-muted">{{ $user->position[0]->position }}</span>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="d-block tx-11 text-muted">Registered:</span>
                                        <h6 class="tx-13 tx-inverse tx-semibold">{{ $user->created_at->format('F d, Y') }}</h6>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item"><span class="d-block tx-11 tx-center">No Member in this department</span></li>
                        @endforelse
                        </ul>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection
@push('script')
    <script>
        function searchList() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            ul = document.getElementById("userList");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                name = li[i].getElementsByTagName("h6")[0].textContent;
                position = li[i].getElementsByTagName("span")[0].textContent;
                date = li[i].getElementsByTagName("h6")[1].textContent;
                console.log(date)
                if (name.toUpperCase().indexOf(filter) > -1 || position.toUpperCase().indexOf(filter) > -1 || date.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
@endpush
