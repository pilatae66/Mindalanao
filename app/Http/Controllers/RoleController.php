<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAllRoles()
    {
        return DataTables::of(Role::with('users')->select('roles.*'))
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
