<?php

namespace App\Http\Controllers;

use App\Models\OprUnit;
use Illuminate\Http\Request;

class OprUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *


     */

     function __construct()
     {
         $this->middleware('permission:inspection-list|inspection-create|inspection-edit|inspection-delete', ['only' => ['index','show']]);
         $this->middleware('permission:inspection-create', ['only' => ['create','store']]);
         $this->middleware('permission:inspection-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:inspection-delete', ['only' => ['destroy']]);
     }
    public function index()
    {
        //
          $oprunits = oprunit::paginate(10);
        return view('oprunits.index',compact('oprunits'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        return view('oprunits.create');
    }

    /**
     * Store a newly created resource in storage.
     *

     */
    public function store(Request $request)
    {
        oprunit::create($request->all());
    
        return redirect()->route('oprunits.index')
                        ->with('success','OU created successfully.');
    }

    /**
     * Display the specified resource.
     *

     */
    public function show(oprunit $oprunit)
    {
        return view('oprunits.show',compact('oprunit'));
    }

    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit(oprunit $oprunit)
    {
        return view('oprunits.edit',compact('oprunit'));
    }

    /**
     * Update the specified resource in storage.
     *
    
     */
    public function update(Request $request,oprunit $oprunit)
    {
        $oprunit->update($request->all());
    
        return redirect()->route('oprunits.index')
                        ->with('success','OU updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy(oprunit $oprunit)
    {
        $oprunit->delete();
    
        return redirect()->route('oprunits.index')
                        ->with('success','OU deleted successfully');
    }
}
