<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Department;

class PositionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        return view('position.index', compact('positions'));
    }

    public function getAllPosition()
    {
        return DataTables::of(Position::with('department')->select('positions.*'))
        ->addColumn('action', function ($position) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('position.edit',$position->id).'" class="btn btn-sm btn-rounded bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Activate Employee">
                            <i class="icon ion-md-open"></i>
                        </a>
                        <button class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2" data-remote="'.route('position.destroy', $position->id).'"><i class="icon ion-md-trash"></i></button
                    </div>';
        })
        ->editColumn('created_at', function($user){
            return $user->created_at->format('F d, Y');
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();

        return view('position.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255|unique:positions',
            'salary' => 'required|numeric|max:1000000'
        ]);

        $position = Position::create([
            'position' => $request->position,
            'salary' => $request->salary
        ]);

        $position->department()->attach($request->department);

        toast('Position has been successfully added!','success', 'top');

        return redirect()->route('position.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        // dd($position->department);
        $departments = Department::all();

        return view('position.edit',compact('position', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'salary' => 'required|string|max:9'
        ]);

        $position->position = $request->position;
        $position->salary = $request->salary;
        $position->save();

        $position->department()->detach($position->department[0]->department_id);
        $position->department()->attach($request->department);

        toast('Position has been successfully updated!','success', 'top');

        return redirect()->route('position.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();

        toast('Position has been successfully deleted!','success', 'top');

        return redirect()->route('position.index');
    }
}
