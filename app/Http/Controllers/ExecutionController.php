<?php

namespace App\Http\Controllers;
use App\Models\Execution;
use App\Models\Inspection;
use App\Models\Planning;
use App\Models\Subplanning;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class ExecutionController extends Controller
{
    public function index(Request $request, $id, $sub_id)
    {
        $parent_planning = Planning::findOrFail($id);
        $subplanning = Subplanning::findOrFail($sub_id);
    
        $search = $request->input('search');
        
        $executions = Execution::where('subplanning_id', $sub_id)
            ->whereHas('inspection', function ($q) use ($search) {
                $q->where('parent_id', 0)
                    ->where('name', 'LIKE', "%$search%");
            })
            ->get();
    
        return view('executions.index', compact('executions', 'parent_planning', 'subplanning', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    public function create($id, $sub_id)
    {
        $inspections = Inspection::where('parent_id', 0)
            ->get();
        $sub_planning = Subplanning::with([
            'parent',
            'groups.users'
        ])
            ->findOrFail($sub_id);
        
        return view('executions.create', compact('inspections','sub_planning'));
    }

    public function store(Request $request, $id, $sub_id)
    {
        $validated = $request->validate([
            'subplanning_id' => 'required',
            'inspection_id' => [
                'required',
                Rule::unique('executions')->where(function ($query) use ($request) {
                    return $query->where('subplanning_id', $request->subplanning_id)
                        ->where('inspection_id', $request->inspection_id);
                }),
            ],
            'user_id' => 'nullable|integer'
        ]);
    
        $inspection = Inspection::with('children')
            ->findOrFail($validated['inspection_id']);
    
        // Create execution for the parent inspection
        $execution = Execution::create($validated);
    
        foreach ($inspection->children as $child) {
            // Create execution for each child inspection
            Execution::create([
                'subplanning_id' => $validated['subplanning_id'],
                'inspection_id' => $child->id,
                'user_id' => $validated['user_id']
            ]);
        }
    
        return redirect()->route('plannings.sub.execution.index', ['id' => $id, 'sub_id' => $sub_id])
            ->with('success', 'Execution created successfully.');
    }
    
    public function show()
    {   
        
    }

    /**
     * Show the form for editing the specified resource.
     *
  
     */


     public function edit($id, $sub_id, $execution_id)
     {
    //     $execution = Execution::query()->with([
    //         'children.children',
    //         'inspection',
    //         'subPlanning'
    //     ])->where('id', $execution_id)->firstOrFail();
    //     dd($execution->toArray());
    //     


         $execution = Execution::findOrFail($execution_id);
         $inspections = Inspection::where('parent_id', 0)->get();
         $sub_planning = Subplanning::with(['parent', 'groups.users'])->findOrFail($sub_id);
     
         $inspection = Inspection::with('children')->findOrFail($execution->inspection_id);
         $executionChildren = $inspection->children()->with('children')->get();
         $executionChildrenIds = $executionChildren->pluck('id');
         $executionChildrenIds = json_decode(json_encode($executionChildrenIds), true);

         foreach ($executionChildren as $key => $child){
            $array = [];

        foreach ($child->children as $index => $grandChild)
         {
            $array[] =  $grandChild->id ;
         }
            //  $executionChildrenIds1 = $child->children->pluck('id');
            //  print_r($executionChildrenIds1);
            // print_r(json_decode(json_encode($child), true));
            // foreach ($child->children as $index => $grandChild){
                if ( !empty($array) ){
                    $executionChildrenIds =  array_merge($executionChildrenIds, array_values($array));
                }
            // }
         }
        // print_r($executionChildrenIds);
        //  $executionChildrenIds2 = $executionChildren->children->pluck('id');
        //  array_merge($executionChildrenIds, $executionChildrenIds2);
            // print_r($executionChildrenIds);
         $executions = \Illuminate\Support\Facades\DB::table('executions')
                   ->whereIn('inspection_id', array_values($executionChildrenIds))
                   ->where('subplanning_id', '=', $sub_id)
                   ->get()->toArray();
                //    print_r($newTableRecords);
        //  $executions = Execution::findOrFail($execution->inspection_id)->get();
        $executions = json_decode(json_encode($executions), true);
        // Extract the 'id' column values
        $idValues = array_column($executions, 'inspection_id');

        // Create a new array with keys matching the 'id' values
        $executions = array_combine($idValues, $executions);

            // Verify the updated array
         return view('executions.edit', compact('execution', 'inspections', 'sub_planning', 'executionChildren', 'executions'))
         ->with('id', $sub_planning->parent->id)
         ->with('sub_id', $sub_planning->id);
     }

     public function update(Request $request, $id, $sub_id, $execution_id)
     {

        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'status' => 'nullable|integer',
            'comment' => 'nullable|string',

            'children.id.*' => 'required|integer',
            'children.status.*' => 'required|in:100,50,0',
            'children.comment.*' => 'nullable|string|max:255',
            'children.user_id.*' => 'nullable|integer',
            
            'children.id.*.children.*.id' => 'required|integer',
            'children.status.*.children.*.status' => 'required|in:100,50,0',
            'children.comment.*.children.*.comment' => 'nullable|string|max:255',
            'children.user_id.*.children.*.user_id' => 'nullable|integer',
        ]);
     
        $execution = Execution::findOrFail($execution_id);
     
        // Update the user ID
        $execution->update($validated);

        dd($validated);

        foreach($validated['children'] as $key => $value){
            $temp_execution = Execution::find($value['id']);
            $temp_execution->update($value);
        }


        //  // Update the execution status and comment for the main execution
        //  $execution->status = $request->input('status.' . $execution_id);
        //  $execution->comment = $request->input('comment.' . $execution_id);
        //  $execution->save();
     
        //  // Update the execution status and comment for each child execution
        //  foreach ($execution->inspection->children as $child) {
        //      $childExecution = Execution::where('inspection_id', $child->id)->firstOrFail();
        //      $childExecution->status = $request->input('status.' . $childExecution->id);
        //      $childExecution->comment = $request->input('comment.' . $childExecution->id);
        //      $childExecution->save();
     
        //      foreach ($child->children as $grandchild) {
        //          $grandchildExecution = Execution::where('inspection_id', $grandchild->id)->firstOrFail();
        //          $grandchildExecution->status = $request->input('status.' . $grandchildExecution->id);
        //          $grandchildExecution->comment = $request->input('comment.' . $grandchildExecution->id);
        //          $grandchildExecution->save();
        //      }
        //  }
     
        return redirect()
            ->back()
            ->with('success', 'Execution updated successfully.');
        // return redirect()->route('plannings.sub.execution.index', ['id' => $id, 'sub_id' => $sub_id])
        //     ->with('success', 'Execution updated successfully.');
     }
     
    /**
     * Remove the specified resource from storage.
     *
 
     */
    public function destroy($id, $sub_id, $execution_id)
    {
        $execution = Execution::findOrFail($execution_id);
        
        $execution->delete();
    
        // Delete associated children executions
        $childrenExecutions = Execution::where('inspection_id', $execution->inspection_id)->get();
        foreach ($childrenExecutions as $childExecution) {
            $childExecution->delete();
        }
    
        return redirect()->route('plannings.sub.execution.index', ['id' => $id, 'sub_id' => $sub_id])
            ->with('success', 'Execution and its children deleted successfully.');
    }
  
    


    
    
    public function generatePDF(Request $request, $id, $sub_id)
    {
        // $parent_planning = Planning::findOrFail($id);
        // $subplanning = Subplanning::findOrFail($sub_id);
         $executions = Execution::where('subplanning_id', $sub_id)->get();
        $inspections = Inspection::all();
        $parent_planning = Planning::findOrFail($id);
        $subplanning = Subplanning::findOrFail($sub_id);
    
        $pdf = new Dompdf();

        //  $logUrl = public_path('sawitkinabalu.png');
    
        return view('pdf.execution', compact('executions','parent_planning', 'subplanning'))  ;

       
    }
    

    }
    


