@extends('layouts.app')


@section('content')
<a class="btn btn-primary" href="{{ route('plannings.index') }}">Back</a>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Schedule</h2>
            </div>
            <div class="pull-right">
                @can('inspection-create')
                    <a class="btn btn-success" href="{{ route('plannings.sub.create', ['id' => $parent_planning->id]) }}">Create New Schedule</a>
                @endcan
            </div>
    </div>
</div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table  table-striped table-bordered table-hover mt-3">
        <tr>
            <th>No</th>
            <th>Operating unit</th>
            <th >Start date</th>
            <th>End date</th>
            <th>Group</th>
            <th width="280px">Action</th>
            @foreach ($parent_planning->children as $key => $sub_id)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ $sub_id->operatingUnits?->map(function($ou) { return $ou->name; })?->implode(', ') }}</td>
                <td>{{ $sub_id->start_date }}</td>
                <td>{{ $sub_id->end_date }}</td>
                <td>{{ $sub_id->groups?->map(function($g) {return $g->type;})?->implode(', ') }}</td>
            
                <td>
                    <form action="{{ route('plannings.sub.destroy', ['id' => $parent_planning->id, 'sub_id' => $sub_id->id]) }}" method="POST">
                        @can('inspection-edit')
                            <a class="btn btn-primary" href="{{ route('plannings.sub.edit', ['id' => $parent_planning->id, 'sub_id' => $sub_id->id]) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('inspection-delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</button>
                        @endcan
                        <a class="btn btn-dark" href="{{ route('plannings.sub.execution.index', [$parent_planning->id, $sub_id->id]) }}" style="background-color: orange">Checklist</a>

                        
                    </form>
                </td>
            
            </tr>
         
        @endforeach
</table>
<p class="text-center text-primary"><small>--</small></p>
@endsection