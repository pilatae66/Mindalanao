<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.index');
    }

    public function getAllUsers()
    {
        return DataTables::of(User::query())
        ->addColumn('action', function ($user) {
            return '<div class="d-flex align-items-baseline">
                        <a href="#edit-'.$user->id.'" class="btn btn-sm btn-rounded bg-white tx-success p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Activate Employee">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button data-remote="/user/'.$user->id.'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
        })
        ->editColumn('created_at', function($user){
            return $user->created_at->format('F d, Y');
        })
        ->editColumn('name', function($user){
            return "{$user->firstname} {$user->middlename[0]}. {$user->lastname}";
        })
        ->make(true);
    }

    public function delete(User $user, Request $request)
    {
        $user->delete();
    }
}
