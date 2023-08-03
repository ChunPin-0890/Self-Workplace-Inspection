<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Subcatinspection;
use Illuminate\Http\Request;

class SubcatinspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index($id, Request $request)
    {
        $parent_inspection = Inspection::with('children')->findOrFail($id);
        $search = $request->input('search');
        $query = SubcatInspection::where('parent_id', $id);
    
        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }
    
        $subcatinspections = $query->paginate(20);
    
        return view('subcatinspections.index', compact('subcatinspections', 'search', 'parent_inspection'))
            ->with('i', ($subcatinspections->currentPage() - 1) * $subcatinspections->perPage());
    }
    
    public function clearIndex()
    {
        return redirect()->route('inspections.sub.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create($id)
    {
        $parent_inspection = Inspection::findOrFail($id);
        $inspections = Inspection::all();
        
        return view('subcatinspections.create', compact('parent_inspection', 'inspections'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
    
     */
    public function store(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required',
        'parent_id' => 'nullable'
    ]);

    $inspection = new Inspection();
    $inspection->name = $validated['name'];
    // Set other attributes of the Inspection model as needed
    $inspection->parent_id = $id; // Assign the value of $id to 'parent_id'
    $inspection->save();

    return redirect()->route('inspections.sub.index', ['id' => $id])
        ->with('success', 'Inspection created successfully.');
}


    /**
     * Display the specified resource.
     *
     * 
     */
    public function show(Subcatinspection $subcatinspection)
    {
        $subcatinspection = Subcatinspection::with('children')->findOrFail($subcatinspection);
        return view('subcatinspections.show',compact('subcatinspection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
    
     */
    public function edit($id, $sub_id)
    {
        $subcatinspection = Inspection::findOrFail($sub_id);
    
        return view('subcatinspections.edit', compact('subcatinspection'));
    }
    

    

    public function update(Request $request, $id, $sub_id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
    
        $subcatinspection = Inspection::findOrFail($sub_id);
        $subcatinspection->update($validated);
    
        return redirect()->route('inspections.sub.index', ['id' => $id])->with('success', 'Subcategory inspection updated successfully.');
    }
    
    


    /**
     * Remove the specified resource from storage.
     *
     
     */
    public function destroy($id, $sub_id)
    {
        $parent_inspection = Inspection::findOrFail($id);
        $subcatinspection = $parent_inspection->children()->findOrFail($sub_id);
        $subcatinspection->delete();
    
        return redirect()->route('inspections.sub.index', ['id' => $id])->with('success', 'Subcategory inspection deleted successfully.');
    }
    
    
}
