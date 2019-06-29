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
        if (Attendance::where('user_id', $request->userId)->where('created_at', '>', Carbon::today())->count() < 6) {
            if (Carbon::now()->between(Attendance::where('user_id', $request->userId)->latest()->first()->created_at, Attendance::where('user_id', $request->userId)->latest()->first()->created_at->addHours(1))) {
                return response()->json([
                    'message' => 'Error: You can time in or out after an hour!'
                ], 500);
            }else{
                $type = Attendance::where('user_id', $request->userId)->where('created_at', '>', Carbon::today())->count() % 2 == 0 ? 'In' : 'Out';
                $attendance =  Attendance::create([
                    'user_id' => $request->userId,
                    'type' => $type,
                    'isHoliday' => $request->isHoliday
                ]);

                return response()->json([
                    'message' => 'Success!',
                'status' => $attendance
                ], 200);
            }
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
    public function showDTR(User $user)
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $day = Carbon::now()->day;
        return view('attendance.showDTR', compact('user', 'month', 'year', 'day'));
    }

    public function getDate(User $user)
    {
        return view('attendance.getDate', compact('user'));
    }

    public function showHRODTR($id, Request $request)
    {
        $user = User::find($id);
        $day = Carbon::parse($request->date)->day;
        $month = Carbon::parse($request->date)->month;
        $year = Carbon::parse($request->date)->year;
        return view('attendance.showDTR', compact('user', 'month', 'year', 'day'));
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
