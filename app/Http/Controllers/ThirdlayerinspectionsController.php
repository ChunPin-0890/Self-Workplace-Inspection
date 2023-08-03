<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Subcatinspection;
use Illuminate\Http\Request;

class ThirdlayerinspectionsController extends Controller
{
    public function index($id, $sub_id)
    {
        $parent_inspection = Inspection::findOrFail($id);
        $subcatinspection = $parent_inspection->children()->findOrFail($sub_id);
        
        $search = request()->input('search');
        $query = $subcatinspection->children();
        
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        
        $thirdlayerinspections = $query->get();
    
        return view('thirdlayerinspections.index', compact('parent_inspection', 'subcatinspection', 'thirdlayerinspections', 'search'));
    }
    
    public function clearIndex()
    {
        return redirect()->route('inspections.sub.third.index');
    }

    public function create($id, $sub_id)
    {
        $parent_inspection = Inspection::findOrFail($id);
        $subcatinspection = $parent_inspection->children()->findOrFail($sub_id);

        return view('thirdlayerinspections.create', compact('parent_inspection', 'subcatinspection'));
    }

    public function store(Request $request, $id, $sub_id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
    
        $parent_inspection = Inspection::findOrFail($id);
        $subcatinspection = Subcatinspection::findOrFail($sub_id);
    
        $inspection = new Inspection();
        $inspection->name = $validated['name'];
        // Set other attributes of the Inspection model as needed
        $inspection->parent_id = $subcatinspection->id; // Assign the value of subcatinspection_id to 'parent_id'
        $inspection->save();
    
        return redirect()->route('inspections.sub.third.index', ['id' => $id, 'sub_id' => $sub_id])
            ->with('success', 'Third Layer Inspection created successfully.');
    }
    
    
    


    public function edit($id, $sub_id, $third_id)
{
    $parent_inspection = Inspection::findOrFail($id);
    $subcatinspection = $parent_inspection->children()->findOrFail($sub_id);
    $thirdlayerinspection = $subcatinspection->children()->findOrFail($third_id);

    return view('thirdlayerinspections.edit', compact('parent_inspection', 'subcatinspection', 'thirdlayerinspection'));
}

public function update(Request $request, $id, $sub_id, $third_id)
{
    $parent_inspection = Inspection::findOrFail($id);
    $subcatinspection = $parent_inspection->children()->findOrFail($sub_id);
    $thirdlayerinspection = $subcatinspection->children()->findOrFail($third_id);

    $validated = $request->validate([
        'name' => 'required',
    ]);

    $thirdlayerinspection->name = $validated['name'];
    // Update other attributes of the third layer inspection as needed
    $thirdlayerinspection->save();

    return redirect()->route('inspections.sub.third.index', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id])
        ->with('success', 'Third Layer Inspection updated successfully.');
}


public function destroy($id, $sub_id, $third_id)
{
    $parent_inspection = Inspection::findOrFail($id);
    $subcatinspection = $parent_inspection->children()->findOrFail($sub_id);
    $thirdlayerinspection = $subcatinspection->children()->findOrFail($third_id);

    // Deletion logic for the third layer inspection
    $thirdlayerinspection->delete();

    return redirect()->route('inspections.sub.third.index', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id])
        ->with('success', 'Third Layer Inspection deleted successfully.');
}
}
