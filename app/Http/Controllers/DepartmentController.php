<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
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
        return view('department.index');
    }

    public function getAllDepartment()
    {
        return DataTables::of(Department::with('employee')->select('departments.*'))
        ->addColumn('action', function ($department) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('department.show',$department->id).'" class="btn btn-sm btn-rounded bg-white p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Show Department Details">
                            <i class="icon ion-md-eye"></i>
                        </a>
                        <a href="'.route('department.edit', $department->id).'" class="btn btn-sm btn-rounded bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Department">
                            <i class="icon ion-md-open"></i>
                        </a>
                        <button data-remote="'.route('department.destroy', $department->id).'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
        })
        ->addColumn('employees', function($department){
            return $department->employee->count();
        })
        ->addColumn('parent', function($department){
            return !empty($department->parent) ? $department->parent->department_name : "No Parent";
        })
        ->editColumn('created_at', function($department){
            return $department->created_at->format('F d, Y');
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();

        return view('department.create', compact('departments'));
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
            'department_name' => 'required|string|max:255|unique:departments',
            'parent_department_id' => 'required|string|max:255|unique:departments'
        ]);

        Department::create($request->all());

        toast('Department has been created successfully!', 'success', 'top');

        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $grossDepartments = Department::all();

        $departments = $grossDepartments->filter(function($department1) use($department){
            return $department1->id != $department->id;
        });

        return view('department.edit', compact('department', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'parent_department_id' => 'required'
        ]);

        toast('Department has been updated successfully!', 'success', 'top');

        $department->update($request->all());

        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
    }
}
