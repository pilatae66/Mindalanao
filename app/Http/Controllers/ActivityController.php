<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('activity.index');
    }

    public function getAllActivity()
    {
        return DataTables::of(Activity::query())
        ->addColumn('action', function ($activity) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('activity.show', $activity->id).'" class="btn btn-rounded bg-white tx-dark p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Show Activity">
                            <i class="icon ion-md-eye"></i>
                        </a>
                        <a href="'.route('activity.edit', $activity->id).'" class="btn btn-rounded bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Show Activity">
                            <i class="icon ion-md-open"></i>
                        </a>
                        <button data-remote="'.route('activity.destroy', $activity->id).'" class="btn btn-rounded tx-danger delete p-0 m-0 pr-2">
                            <i class="icon ion-md-trash"></i>
                        </button>
                    </div>';
        })
        ->editColumn('activity_time', function($activity){
            return Carbon::parse($activity->activity_time)->format('h:i a');
        })
        ->editColumn('created_at', function($activity){
            return $activity->created_at->format('F d, Y');
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
        return view('activity.create');
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
            'activity_name' => 'required|string|max:255',
            'activity_venue' => 'required|string|max:255',
            'activity_description' => 'required|string',
            'activity_date' => 'required|date',
            'activity_time' => 'required|string',
            'activity_provider' => 'required|string|max:255'
        ]);

        Activity::create($request->all());

        return redirect()->route('activity.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activity.show', compact('activity'));
    }

    public function getAllAttendees(Activity $activity)
    {
        return DataTables::of($activity->attendees)
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
        ->addColumn('action', function ($activity) {
            return '<div class="d-flex align-items-baseline">
                        <attendee-button></attendee-button>
                    </div>';
        })
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        return view('activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'activity_name' => 'required|string|max:255',
            'activity_venue' => 'required|string|max:255',
            'activity_description' => 'required|string',
            'activity_date' => 'required|date',
            'activity_time' => 'required|string',
            'activity_provider' => 'required|string|max:255'
        ]);

        $activity->update($request->all());

        return redirect()->route('activity.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
    }
}
