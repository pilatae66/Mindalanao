<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use App\Position;
use App\Department;

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
                        <button data-remote="/users/'.$user->id.'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
        })
        ->addColumn('position', function ($user){
            return $user->position[0]->position;
        })
        ->addColumn('department', function ($user){
            return $user->department[0]->department_name;
        })
        ->editColumn('created_at', function($user){
            return $user->created_at->format('F d, Y');
        })
        ->editColumn('name', function($user){
            return "{$user->firstname} {$user->middlename[0]}. {$user->lastname}";
        })
        ->make(true);
    }

    public function create()
    {
        $positions = Position::all();
        $departments = Department::all();

        return view('user.create', compact('positions', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|max:255|unique:users',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'degree' => $request->degree,
            'email' => $request->email,
            'username' => $request->username,
        ]);

        $user->position()->attach($request->position);
        $user->department()->attach($request->department);

        return redirect()->route('user.index');
    }

    public function delete(User $user, Request $request)
    {
        $user->delete();
    }
}
