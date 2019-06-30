<?php

namespace App\Http\Controllers;

use App\Leave;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\User;
use App\LeaveType;
use PDF;

class LeaveController extends Controller
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
        $this->authorize('view', Leave::class);

        return view('leave.index');
    }
    public function getAllLeaves()
    {
        return DataTables::of(Leave::with('user')->with('admin')->with('type')->select('leaves.*'))
        ->addColumn('action', function ($leave) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('leave.edit', $leave->id).'" class="btn btn-sm btn-rounded bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Department">
                            <i class="icon ion-md-open"></i>
                        </a>
                        <button data-remote="'.route('leave.destroy', $leave->id).'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
        })
        ->editColumn('isApproved', function($leave){
            return $leave->isApproved == 0 ? '<div class="tx-danger"><i class="icon ion-md-close"></i> Not Approved</div>' : '<div class="tx-success"><i class="icon ion-md-checkmark"></i> Approved</div>';
        })
        ->addColumn('user.full_name', function($leave){
            return $leave->user->full_name;
        })
        ->addColumn('type.name', function($leave){
            return $leave->type->name;
        })
        ->addColumn('admin.full_name', function($leave){
            return $leave->admin->full_name;
        })
        ->editColumn('created_at', function($leave){
            return $leave->created_at->format('F d, Y');
        })
        ->rawColumns(['action', 'isApproved'])
        ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Leave::class);

        $leaveTypes = LeaveType::all();
        $users = User::where('role', '!=' ,'Admin')->get();

        return view('leave.create', compact('users', 'leaveTypes'));
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
            'leave_type_id' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'start_date' => 'required|string|max:20',
            'end_date' => 'required|string|max:20'
        ]);
        /**Check if end date is greater than start date */
        if (Carbon::parse($request->end_date) >= Carbon::parse($request->start_date)) {
            /**Check if end date and start date is greater than the date today  */
            if (Carbon::parse($request->end_date) < Carbon::now() || Carbon::parse($request->start_date) < Carbon::now()) {
                alert()->error('Error!','Leave date must be greater than today')->showConfirmButton('Confirm', '#3085d6');;

                return redirect()->back()->withInput();
            }
            else{
                /**Calculation for the sum of number of leave days on the user */
                $user_leaves_count = Leave::where('leave_type_id', $request->leave_type_id)
                                    ->where('employee_id', $request->employee_id)->get();

                $type = LeaveType::find($request->leave_type_id);
                /**Check if user has more leave days */
                if ($user_leaves_count->sum('number_of_days') < $type->days_allowed) {
                    Leave::create($request->all());

                    toast('Leave successfully filed!', 'success', 'top');

                    return redirect()->route('leave.index');
                }
                else{
                    alert()->error('Error!',"Employee {$user_leaves_count[0]->user->full_name} reached the maximum limit on {$user_leaves_count[0]->type->name} leave type!")->showConfirmButton('Confirm', '#3085d6');;

                    return redirect()->back()->withInput();
                }
            }
        }
        else{
            alert()->error('Error!','End Date must be greater than Start Date!')->showConfirmButton('Confirm', '#3085d6');;

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    public function showAll()
    {
        $leavetypes = LeaveType::all();
        $leaves = Leave::where('employee_id', auth()->user()->id)->get();

        return view('leave.showAll', compact('leaves', 'leavetypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        $this->authorize('update', Leave::class);

        $users = User::all();
        $leaveTypes = LeaveType::all();

        return view('leave.edit', compact('leave', 'users', 'leaveTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        $this->authorize('update', $leave);
        $request->validate([
            'leave_type_id' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'start_date' => 'required|string|max:20',
            'end_date' => 'required|string|max:20',
        ]);
        /**Check if end date is greater than start date */
        if (Carbon::parse($request->end_date) >= Carbon::parse($request->start_date)) {
            /**Check if end date and start date is greater than the date today  */
            if (Carbon::parse($request->end_date) < Carbon::now() || Carbon::parse($request->start_date) < Carbon::now()) {
                alert()->error('Error!','Leave date must be greater than today')->showConfirmButton('Confirm', '#3085d6');;

                return redirect()->back()->withInput();
            }
            else{
                $leave->update($request->all());

                toast('Leave has been successfully updated!', 'success', 'top');

                return redirect()->route('leave.index');
            }
        }
        else{
            alert()->error('Error!','End Date must be greater than Start Date!')->showConfirmButton('Confirm', '#3085d6');;

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        $this->authorize('delete', $leave);
        $leave->delete();
    }

    public function printLeaves()
    {
        $leaves = Leave::join('users', 'users.id' ,'=', 'leaves.employee_id')->select('users.*')->orderBy('users.lastname', 'ASC')->get();
        $pdf = PDF::loadView('print.leave', compact('leaves'));
        return $pdf->stream('leaves.pdf');
    }
}
