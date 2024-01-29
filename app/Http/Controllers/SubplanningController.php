<?php

namespace App\Http\Controllers;
use App\Models\Execution;
use App\Models\Group;
use App\Models\Inspection;
use App\Models\Oprunit;
use App\Models\Planning;
use App\Models\Subplanning;
use Illuminate\Http\Request;

class SubplanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    
     */
    public function index($id)
    {
    
        $parent_planning = Planning::with('children')->findOrFail($id);

        return view('subplannings.index', compact('parent_planning'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create($id)
    {
        
        $oprs = Oprunit::all();
        $groups = Group::all();
        $parent_planning = Planning::with('children')->findOrFail($id);

        return view('subplannings.create', compact('parent_planning', 'oprs', 'groups'));
      

    }

    /**
     *
     *  Store a newly created resource in storage.
     *
 
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'planning_id' => 'required',

            'group_id' => 'required',
            'ou_id' => 'required',
            
        ]);
        
        $sub_planning = Subplanning::create($validated);

        $sub_planning->groups()?->attach($validated['group_id']);
        $sub_planning->operatingUnits()?->attach($validated['ou_id']);
        
        // Checklist
        // query inspections checklist item based on OU type
        //loop a foreach for inspection checklist items and create a checklist
        
        $ou = OprUnit::find($validated['ou_id']);
        $ouType = $ou->type;
    
        // Query inspections based on OU type.
        $inspections = Inspection::where('type', $ouType)->get();
        
        foreach ($inspections as $inspection) {
            
            // Create checklist based on $inspection
            Execution::create([
                // Fill in the column that need to create execution.
                'subplanning_id' => $sub_planning->id,
                'inspection_id' => $inspection->id,
                'user_id' => 0
            ]);

            // Get Children based on $inspection.
            $children = $inspection->children;
            Execution::createAllChildren($inspection, $sub_planning->id, 0);
            
        }
        
        return redirect()->route('plannings.sub.index', ['id' => $id])
        ->with('success', 'Schedule created successfully.');
    }
    /**
     * Display the specified resource.

     */
    public function show(Subplanning $subplanning)
    {
        return view('subplannings.show',compact('subplannings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
  
     */
    public function edit($id, $sub_id)
    {
        $parent_planning = Planning::findOrFail($id);
        $sub_planning = $parent_planning->children()->findOrFail($sub_id);
        $oprs = Oprunit::all();
        $groups = Group::all();
        return view('subplannings.edit', compact('parent_planning', 'sub_planning','oprs','groups'));
    }

    public function update(Request $request, $id, $sub_id)
    {
        $parent_planning = Planning::findOrFail($id);
        $sub_planning = $parent_planning->children()->findOrFail($sub_id);

        $validated = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'planning_id' => 'required',
    
            'group_id' => 'required',
            'ou_id' => 'required',
        ]);
    
    
        $sub_planning->update($request->all());

        $sub_planning->operatingUnits()->sync([$request->ou_id]);
        $sub_planning->groups()->sync([$request->group_id]);
        
        return redirect()->route('plannings.sub.index', ['id' => $id])
                        ->with('success', 'Schedule updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
 
     */
   // SubplanningController.php

/**
 * Remove the specified resource from storage.
 */
public function destroy($id, $sub_id)
{
    $parent_planning = Planning::findOrFail($id);
    $subplanning = $parent_planning->children()->findOrFail($sub_id);
    
    $subplanning->delete();

    return redirect()->route('plannings.sub.index', ['id' => $parent_planning->id])
                    ->with('success', 'Schedule deleted successfully.');
}

}
