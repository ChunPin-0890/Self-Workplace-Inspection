@extends('layouts.app')

@section('content')
<a class="btn btn-primary" href="{{ route('plannings.sub.index',['id' => $parent_planning->id]) }}">Back</a>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Checklist</h2>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="pull-right">
                <a href="{{ route('plannings.sub.printpdf', ['id' => $parent_planning->id, 'sub_id' => $subplanning->id]) }}" class="btn btn-primary ">Generate PDF</a>
                {{-- @can('inspection-create')
                    <a class="btn btn-success" href="{{ route('plannings.sub.execution.create', ['id' => $subplanning->parent->id, 'sub_id' => $subplanning->id]) }}">Create New Schedule</a>
                @endcan --}}
                
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
            </div>
            

            <div>
                <form action="{{ route('plannings.sub.execution.index', ['id' => $parent_planning->id, 'sub_id' => $subplanning->id]) }}" method="GET" class="form-inline">
                   <div class="d-flex justify-content-end">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ $search }}">
        <div class="input-group-append ml-auto">
            <button type="submit" class="btn btn-primary">Search</button>
            @if ($search)
                <a href="{{ route('plannings.sub.execution.index', ['id' => $parent_planning->id, 'sub_id' => $subplanning->id]) }}" class="btn btn-secondary">Clear</a>
            @endif
        </div>
    </div>
</div>

<!-- Add this button/link inside the index.blade.php view -->


                </form>



            </div>
        </div>
    </div>
</div>

@if ($executions->isNotEmpty())
    <table class="table table-bordered table-hover mt-4">
        <tr>
            <th width="100px" style="text-align: center;">No</th>
            <th width="300px">Name</th>
            <th width="120px">Status</th>
            {{-- <th width="460px">Comment</th> --}}
            <th width="100px">Action</th>
        </tr>
        @foreach ($executions as $key => $execution)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ $execution->inspection->name }}</td>
                <td>{{ $execution->status }}</td>
                {{-- <td>{{ $execution->comment }}</td> --}}
                <td>
                    <form action="{{ route('plannings.sub.execution.destroy', ['id' => $parent_planning->id, 'sub_id' => $subplanning->id, 'execution_id' => $execution->id]) }}" method="POST">
                        @can('inspection-edit')
                            <a class="btn btn-primary" href="{{ route('plannings.sub.execution.edit', ['id' => $parent_planning->id, 'sub_id' => $subplanning->id, 'execution_id' => $execution->id]) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('inspection-delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete: {{ $execution->inspection->name }}?')">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
            {{-- @foreach ($execution->inspection->children as $child)
                <tr>
                    <td style="text-align: center;"></td>
                    <td>{{ $child->name }}</td>
                    <td>{{ $child->status }}</td>
                    <td>{{ $child->comment }}</td>
                    <td>
                        <!-- Add actions for child inspection -->
                    </td>
                </tr>
                @foreach ($child->children as $grandChild)
                    <tr>
                        <td style="text-align: center;"></td>
                        <td>{{ $grandChild->name }}</td>
                        <td>{{ $grandChild->status }}</td>
                        <td>{{ $grandChild->comment }}</td>
                        <td>
                            <!-- Add actions for grandchild inspection -->
                        </td>
                    </tr>
                @endforeach
            @endforeach --}}
        @endforeach
    </table>
@else
    <p class="mt-4">No search results found.</p>
@endif

<p class="text-center text-primary mt-4"><small>--</small></p>
@endsection
