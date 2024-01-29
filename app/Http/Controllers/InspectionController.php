<?php
    
namespace App\Http\Controllers;
    
use App\Models\Inspection;
use Illuminate\Http\Request;
    
class InspectionController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Inspection::where('parent_id', 0)
            ->with([
                'parent',
                'children'
            ]);
    
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%")
                          ->orWhere('type', 'LIKE', "%$search%");
                });
            }
            
        $inspections = $query->paginate(20);
    
        return view('inspections.index', compact('inspections', 'search'))
            ->with('i', ($inspections->currentPage() - 1) * $inspections->perPage());
    }
    
    public function clearIndex()
    {
        return redirect()->route('inspections.index');
    }
    

    
    /**
     * Show the form for creating a new resource.
     *
     * @
     */
    public function create()
    {
        $inspections = Inspection::all();
        return view('inspections.create', [
            'inspections' => $inspections
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
  
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
          
            'type' => 'required',
            'parent_id' => 'nullable'
        ]);
    
        Inspection::create($validated);
    
        return redirect()->route('inspections.index')
                        ->with('success','Inspections created successfully.');
    }
    
    /**
     * Display the specified resource.
     *

     */
    public function show(Inspection $inspection)
    {
        return view('inspections.show',compact('inspection'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
   
     */
    public function edit(Inspection $inspection)
    {
        return view('inspections.edit',compact('inspection'));
    }
    
    /**
     * Update the specified resource in storage.
     *

     */
    public function update(Request $request, Inspection $inspection)
    {
         request()->validate([
            'name' => 'required',
            
            'type' => 'required',
            'parent_id' => 'nullable'
        ]);
    
        $inspection->update($request->all());
    
        return redirect()->route('inspections.index')
                        ->with('success','Inspections updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
 
     */
    public function destroy(Inspection $inspection)
    {
        $inspection->delete();
    
        return redirect()->route('inspections.index')
                        ->with('success','Inspections deleted successfully');
    }
    

}