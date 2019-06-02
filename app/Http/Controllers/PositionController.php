<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('position.index');
    }

    public function getAllPosition()
    {
        return DataTables::of(Position::all())
        ->addColumn('action', function ($user) {
            return '<div class="d-flex align-items-baseline">
                        <a href="/position/'.$user->id.'/edit" class="btn btn-sm btn-rounded bg-white tx-success p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Activate Employee">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button data-remote="/position/'.$user->id.'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
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
        return view('position.create');
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
            'position' => 'required|string|max:255|unique:positions'
        ]);

        $position = new Position;
        $position->position = $request->position;

        $position->save();

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
        return view('position.edit',compact('position'));
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
            'position' => 'required|string|max:255|unique:positions'
        ]);

        $position->position = $request->position;
        $position->save();

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

        return redirect()->route('position.index');
    }
}
