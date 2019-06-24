<?php

namespace App\Http\Controllers;

use App\compensation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompensationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('compensation.index');
    }

    public function getAll()
    {
        return DataTables::of(Compensation::query())
        ->addColumn('action', function ($compensation) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('compensation.edit', $compensation->id).'" class="btn btn-sm btn-rounded bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Compensation">
                            <i class="icon ion-md-open"></i>
                        </a>
                        <button data-remote="'.route('compensation.destroy', $compensation->id).'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
        })
        ->editColumn('created_at', function($compensation){
            return $compensation->created_at->format('F d, Y');
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
        return view('compensation.create');
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
            'amount' => 'required|numeric'
        ]);

        Compensation::create($request->all());

        toast('Compensation has been successfully created!', 'success', 'top');

        return redirect()->route('compensation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\compensation  $compensation
     * @return \Illuminate\Http\Response
     */
    public function show(Compensation $compensation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\compensation  $compensation
     * @return \Illuminate\Http\Response
     */
    public function edit(Compensation $compensation)
    {
        return view('compensation.edit', compact('compensation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\compensation  $compensation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compensation $compensation)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric'
        ]);

        $compensation->update($request->all());

        toast('Compensation has been successfully updated!', 'success', 'top');

        return redirect()->route('compensation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\compensation  $compensation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compensation $compensation)
    {
        $compensation->delete();
    }
}
