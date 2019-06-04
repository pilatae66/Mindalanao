<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
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
        return DataTables::of(Department::query())
        ->addColumn('action', function ($department) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('department.edit', $department->id).'" class="btn btn-sm btn-rounded bg-white tx-success p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Department">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="departments/'.$department->id.'/edit" class="btn btn-sm btn-rounded bg-white tx-success p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Department">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button data-remote="'.route('department.destroy', $department->id).'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
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
        return view('department.create');
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
            'department_name' => 'required|string|max:255|unique:departments'
        ]);

        Department::create($request->all());

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
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
            'department_name' => 'required|string|max:255|unique:departments'
        ]);

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
