<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
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
        $zones = Zone::with('groups')
        ->get();
    
    return view('zones.index',[
        'zones' => $zones
    ]);;
    }

    /**
     * Show the form for creating a new resource.
    
     */
    public function create()
    {
        return view('zones.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
  
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:zone_1,zone_2,zone_3,zone_4|unique:zones'
        ]);
        Zone::create($validated);
    
        return redirect()->route('zones.index')
                        ->with('success','Zone created successfully.');
    }

    /**
     * Display the specified resource.
     *
     
     */
    public function show(Zone $zone)
    {
        return view('zones.show',compact('zones'));
    }

    /**
     * Show the form for editing the specified resource.
  
     */
    public function edit(Zone $zone)
    {
        $groups = Group::all();
        return view('zones.edit',compact('zone', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
   
     */
    public function update(Request $request,Zone $zone)
    {
        $validated = $request->validate([
            'group_id' => 'required|integer'
        ]);
        $zone->groups()->attach($validated);
    
        return redirect()
        ->back()
        ->with('success','Zone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
    
     */
    public function destroy(Zone $zone)
    {
        
        $zone->delete();
    
        return redirect()->route('zones.index')
                        ->with('success','Zone deleted successfully');
    }

    public function destroyGroup(Request $request, Zone $zone, Group $group)
    {
    $zone->groups()->detach($group);

        return redirect()
            ->back();
    }

}
