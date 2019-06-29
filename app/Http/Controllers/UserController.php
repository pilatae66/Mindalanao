<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use App\Position;
use App\Department;
use Image;
use Illuminate\Support\Facades\URL;
use GuzzleHttp\Client;
use PDF;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (URL::current() == route('user.index')) {
            return view('user.index');
        }
        else if(URL::current() == route('admin.index')){
            return view('admin.index');

        }
    }

    public function getAllAdmins()
    {
        return DataTables::of(User::with('position')->with('department')->where('role', 'Admin')->select('users.*'))
                    ->addColumn('action', function ($user) {
                        return '<a href="'.route('admin.edit', $user->id).'" class="bg-white tx-primary p-0 m-0" data-toggle="tooltip" data-placement="top" title="Edit User">
                                    <i class="icon ion-md-open"></i>
                                </a>
                                <button data-remote="'.route('user.delete', $user->id).'" class="btn bg-white tx-danger delete p-0 m-0 pl-1 pb-1">
                                    <i class="fas fa-trash"></i>
                                </button>';
                    })
                    ->editColumn('created_at', function($user){
                        return $user->created_at->format('F d, Y');
                    })
                    ->editColumn('name', function($user){
                        return "{$user->firstname} {$user->middlename[0]}. {$user->lastname}";
                    })
                    ->addColumn('photo', function($user){
                        if($user->photoURL){
                            return '<div>
                                        <img class="rounded-circle" src="'.asset('storage/'.$user->photoURL).'" height="70px" style="border: 1px solid gray; padding: 3px;" alt="your image" />
                                    </div>';
                        }
                        else{
                            return '<div>
                                        <img class="rounded-circle" src="'.asset('storage/photos/image.gif').'" height="70px" style="border: 1px solid gray; padding: 3px;" alt="your image" />
                                    </div>';
                        }
                    })
                    ->filterColumn('position', function($query, $keyword){
                        $query->position->where('position', ["%$keyword"]);
                    })
                    ->rawColumns(['photo', 'action'])
                    ->make(true);
    }

    public function getAllUsers()
    {
        if (auth()->user()->role == 'HRO') {
            return DataTables::of(User::with('position')->with('department')->where('role', '!=', 'Admin')->select('users.*'))
                    ->addColumn('action', function ($user) {
                        return '<a href="'.route('user.edit', $user->id).'" class="bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit User">
                                    <i class="icon ion-md-open"></i>
                                </a>
                                <a href="'.route('attendance.getDate',$user->id).'" class="bg-white tx-warning pr-2" title="View Employee\'s DTR">
                                    <i class="icon ion-md-clock"></i>
                                </a>
                                <a href="'.route('payslip.showAll',$user->id).'" class="bg-white tx-success" title="View Employee\'s Payslip">
                                    <i class="icon ion-md-list-box"></i>
                                </a>';
                    })
                    ->editColumn('created_at', function($user){
                        return $user->created_at->format('F d, Y');
                    })
                    ->editColumn('name', function($user){
                        return "{$user->firstname} {$user->middlename[0]}. {$user->lastname}";
                    })
                    ->addColumn('photo', function($user){
                        if($user->photoURL){
                            return '<div>
                                        <img class="rounded-circle" src="'.asset('storage/'.$user->photoURL).'" height="70px" style="border: 1px solid gray; padding: 3px;" alt="your image" />
                                    </div>';
                        }
                        else{
                            return '<div>
                                        <img class="rounded-circle" src="'.asset('storage/photos/image.gif').'" height="70px" style="border: 1px solid gray; padding: 3px;" alt="your image" />
                                    </div>';
                        }
                    })
                    ->filterColumn('position', function($query, $keyword){
                        $query->position->where('position', ["%$keyword"]);
                    })
                    ->rawColumns(['photo', 'action'])
                    ->make(true);
        }else if(auth()->user()->role == 'Admin'){
            return DataTables::of(User::with('position')->with('department')->where('role', '!=', 'Admin')->select('users.*'))
                    ->addColumn('action', function ($user) {
                        return '<button data-remote="'.route('user.delete', $user->id).'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                                        <i class="fas fa-trash"></i>
                                    </button>';
                    })
                    ->editColumn('created_at', function($user){
                        return $user->created_at->format('F d, Y');
                    })
                    ->editColumn('name', function($user){
                        return "{$user->firstname} {$user->middlename[0]}. {$user->lastname}";
                    })
                    ->addColumn('photo', function($user){
                        if($user->photoURL){
                            return '<div>
                                        <img class="rounded-circle" src="'.asset('storage/'.$user->photoURL).'" height="70px" style="border: 1px solid gray; padding: 3px;" alt="your image" />
                                    </div>';
                        }
                        else{
                            return '<div>
                                        <img class="rounded-circle" src="'.asset('storage/photos/image.gif').'" height="70px" style="border: 1px solid gray; padding: 3px;" alt="your image" />
                                    </div>';
                        }
                    })
                    ->filterColumn('position', function($query, $keyword){
                        $query->position->where('position', ["%$keyword"]);
                    })
                    ->rawColumns(['photo','action'])
                    ->make(true);
        }

    }

    public function create()
    {
        $this->authorize('create', User::class);
        $positions = Position::all();
        $departments = Department::all();

        return view('user.create', compact('positions', 'departments'));
    }

    public function store(Request $request)
    {
        // return $request->file('photoURL')->store('photos', 'public');
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
            'role' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'photoURL' => 'file|image|mimes:jpeg,jpg,gif,png'
        ]);
        if(!empty($request->photoURL)){
            $imagePath = $request->file('photoURL')->store('photos', 'public');
            // dd($imagePath);
            $image = Image::make(storage_path("app/public/{$imagePath}"))->fit(150,150);
            $image->save();
            $user = User::create([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'role' => $request->role,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'degree' => $request->degree,
                'email' => $request->email,
                'username' => $request->username,
                'photoURL' => $imagePath
            ]);
        }
        else{
            $user = User::create([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'role' => $request->role,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'degree' => $request->degree,
                'email' => $request->email,
                'username' => $request->username
            ]);

        }


        $user->position()->attach($request->position);
        $user->department()->attach($request->department);

        if ($request->role == 'Admin') {
            toast('Admin has been successfully added!','success', 'top');
            return redirect()->route('admin.index');
        }else{
            toast('Employee has been successfully added!','success', 'top');
            return redirect()->route('user.index');
        }
    }

    public function delete(User $user, Request $request)
    {
        $this->authorize('delete', User::class);

        $user->delete();
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $positions = Position::all();
        $departments = Department::all();

        return view('user.edit', compact('user', 'positions', 'departments'));
    }

    public function editAdmin(User $user)
    {

        $this->authorize('updateAdmin', User::class);
        $positions = Position::all();
        $departments = Department::all();

        return view('admin.edit', compact('user', 'positions', 'departments'));
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);

        $user->department()->sync([$request->department]);
        $user->position()->sync([$request->position]);

        toast('Employee has been updated successfully!', 'success', 'top');

        return redirect()->route('user.index');
    }

    public function updateAdmin(User $user, Request $request)
    {
         // return $request->file('photoURL')->store('photos', 'public');
         $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'photoURL' => 'file|image|mimes:jpeg,jpg,gif,png'
        ]);
        if(!empty($request->photoURL)){
            $imagePath = $request->file('photoURL')->store('photos', 'public');
            // dd($imagePath);
            $image = Image::make(storage_path("app/public/{$imagePath}"))->fit(150,150);
            $image->save();
            $user->update([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'role' => $request->role,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'degree' => $request->degree,
                'email' => $request->email,
                'username' => $request->username,
                'photoURL' => $imagePath
            ]);
        }
        else{
            $user->update([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'role' => $request->role,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'degree' => $request->degree,
                'email' => $request->email,
                'username' => $request->username
            ]);

        }


        $user->position()->sync([$request->position]);
        $user->department()->sync([$request->department]);

        toast('Employee has been successfully updated!','success', 'top');

        return redirect()->route('admin.index');
    }

    public function getAllUsersAPI()
    {
        return User::doesntHave('position')->get();
    }

    public function printEmployees()
    {
        $employees = User::where('role', 'Employee')->orderBy('lastname', 'ASC')->get();
        $pdf = PDF::loadView('print.employee', compact('employees'));
        return $pdf->stream('employees.pdf');
    }
}
