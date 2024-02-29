<?php
    
namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
    
class GroupingController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     */
    public function index()
    {
        
        $groups = Group::with('users')
            ->get();
        
        return view('groupings.index',[
            'groups' => $groups
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
  
     */
    public function create()
    {
        return view('groupings.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:group_1,group_2,group_3,group_4|unique:groups'
        ]);
    
        Group::create($validated);
    
        return redirect()->route('groupings.index')
                        ->with('success','Group created successfully.');
    }
    
    /**a
     * Display the specified resource.
     *
     * @param  \App\grouping  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('groupings.show',compact('grouping'));
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
    
     */
    public function edit(Group $group)
    {
        $users = User::all();

        return view('groupings.edit',compact('group', 'users'));
    }
    
    /**
     * Update the specified resource in storage.
     *
    
     */
    public function update(Request $request, Group $group)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer'
        ]);

        $group->users()->attach($validated);
    
        return redirect()
            ->back()
            ->with('success','Group updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy(Group $group)
    {
        $group->delete();
    
            return redirect()->route('groupings.index')
                            ->with('success','Group deleted successfully');
    }

    public function destroyUserGroup(Request $request, Group $group, User $user)
    {
        $group->users()->detach($user);

        return redirect()
            ->back();
    }
}

// id, name, status, detail, parent_id, type
// 1, spray, active, detail, 2, kilang