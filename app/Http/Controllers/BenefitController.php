<?php

namespace App\Http\Controllers;

use App\Benefit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('benefit.index');
    }

    public function getAllBenefits()
    {
        return DataTables::of(Benefit::query())
        ->addColumn('action', function ($benefit) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('benefit.edit', $benefit->id).'" class="btn btn-sm btn-rounded bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Benefit">
                            <i class="icon ion-md-open"></i>
                        </a>
                        <button data-remote="'.route('benefit.destroy', $benefit->id).'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
        })
        ->editColumn('amount', function($benefit){
            return "₱".number_format($benefit->amount, 0, '.', ',');
        })
        ->editColumn('created_at', function($benefit){
            return $benefit->created_at->format('F d, Y');
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('benefit.create');
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
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|max:1000000'
        ]);

        Benefit::create($request->all());

        toast('Benefit has been successfully created!', 'success', 'top');

        return redirect()->route('benefit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function show(Benefit $benefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function edit(Benefit $benefit)
    {
        return view('benefit.edit', compact('benefit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Benefit $benefit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|max:1000000'
        ]);

        $benefit->update($request->all());

        toast('Benefit has been successfully updated!', 'success', 'top');

        return redirect()->route('benefit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Benefit $benefit)
    {
        $benefit->delete();
    }
}
