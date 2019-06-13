<?php

namespace App\Http\Controllers;

use App\Deduction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('deduction.index');
    }

    public function getAllDeduction()
    {
        return DataTables::of(Deduction::query())
        ->addColumn('action', function ($deduction) {
            return '<div class="d-flex align-items-baseline">
                        <a href="'.route('deduction.edit', $deduction->id).'" class="btn btn-sm btn-rounded bg-white tx-primary p-0 m-0 pr-2" data-toggle="tooltip" data-placement="top" title="Edit Deduction">
                            <i class="icon ion-md-open"></i>
                        </a>
                        <button data-remote="'.route('deduction.destroy', $deduction->id).'" class="btn btn-sm btn-rounded bg-white tx-danger delete p-0 m-0 pr-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>';
        })
        ->editColumn('amount', function($deduction){
            return "₱".number_format($deduction->amount, 0, '.', ',');
        })
        ->editColumn('created_at', function($deduction){
            return $deduction->created_at->format('F d, Y');
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deduction.create');
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

        Deduction::create($request->all());

        toast('Deduction has been successfully created!', 'success', 'top');

        return redirect()->route('deduction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Deduction $deduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        return view('deduction.edit', compact('deduction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|max:1000000'
        ]);

        $deduction->update($request->all());

        toast('Deduction has been successfully updated!', 'success', 'top');

        return redirect()->route('deduction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deduction $deduction)
    {
        $deduction->delete();
    }
}
