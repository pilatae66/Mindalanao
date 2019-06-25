<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use QrCode;
use App\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('attendance.index');
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
        if (Attendance::where('user_id', $request->userId)->where('created_at', '>', Carbon::today())->count() < 2) {
            $type = Attendance::where('user_id', $request->userId)->where('created_at', '>', Carbon::today())->count() > 0 ? 'Out' : 'In';
            $attendance =  Attendance::create([
                'user_id' => $request->userId,
                'type' => $type
            ]);

            return response()->json([
                'message' => 'Success!',
            'status' => $attendance
            ]);
        }
        else{
            return response()->json([
                'message' => 'Error: Double Entry!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
