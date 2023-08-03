<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use Illuminate\Http\Request;
class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
        $plannings = Planning::paginate(10);
      
        return view('plannings.index',compact('plannings'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
         return view('plannings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'year' => 'required|string',
            // Add other validation rules for your Planning model attributes if needed
        ]);
    
        $planning = Planning::create($validatedData);
    
        return redirect()->route('plannings.index')
        ->with('success', 'Planning created successfully.');

    }
    

    /**
     * Display the specified resource.
     *
     *
     */
    public function show(planning $planning)
    {
        
        return view('plannings.show',compact('planning'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit($id)
    {
        $planning = Planning::find($id);

        return view('plannings.edit',compact('planning'));
    }

    /**
     * Update the specified resource in storage.
     *
    
     */
    public function update(Request $request,planning $planning)
    {
        $planning->update($request->all());
    
        return redirect()->route('plannings.index')
        ->with('success', 'Planning updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
 
     */
    public function destroy(planning $planning)
    {
        $planning->delete();
    
        return redirect()->route('plannings.index')
                        ->with('success','Planning deleted successfully');
    }
}
