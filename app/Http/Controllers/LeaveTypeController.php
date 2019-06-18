<?php

namespace App\Http\Controllers;

use App\LeaveType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leavetype.index');
    }

    public function getAllTypes()
    {
        return DataTables::of(LeaveType::query())
        ->addColumn('action', function ($leavetype) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('leaveType.edit', $leavetype->id).'" class="btn btn-sm btn-rounded bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Leave Type">
                            <i class="icon ion-md-open"></i>
                        </a>
                        <button data-remote="'.route('leaveType.destroy', $leavetype->id).'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Leave Type">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
        })
        ->editColumn('created_at', function($leavetype){
            return $leavetype->created_at->format('F d, Y');
        })
        ->editColumn('days_allowed', function($leavetype){
            return "{$leavetype->days_allowed} days";
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leavetype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'days_allowed' => 'required|numeric'
        ]);

        LeaveType::create($request->all());

        toast('Leave Type has been successfully created!', 'success', 'top');

        return redirect()->route('leaveType.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveType $leaveType)
    {
        return view('leaveType.edit', compact('leaveType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveType $leaveType)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'days_allowed' => 'required|numeric'
        ]);

        $leaveType->update($request->all());

        toast('Leave Type has been successfully updated!', 'success', 'top');

        return redirect()->route('leaveType.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();
    }
}
