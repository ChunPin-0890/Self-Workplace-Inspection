@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Zone</h2>
            </div>
            <div class="pull-right">
                @can('inspection-create')
                <a class="btn btn-success" href="{{ route('zones.create') }}"> Create new</a>
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
            <th >Zone Type</th>
            <th width="280px">Action</th>
            </tr>
	    @foreach ($zones as $zone)
	    <tr>
	        <td>{{ $zone->type }}</td>

	        <td>
                <form action="{{ route('zones.destroy', [ 'zone' => $zone->id ]) }}" method="POST">
                    @csrf
                    {{-- <a class="btn btn-info" href="{{ route('groupings.show', $group->id) }}">Show</a> --}}
                    @can('inspection-edit')
                    <a class="btn btn-primary" href="{{ route('zones.edit',  [ 'zone' => $zone->id ]) }}">Edit</a>
                    @endcan

                    @method('DELETE')
                    @can('inspection-delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete: {{ $zone->type }}?')">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
   

<p class="text-center text-primary"><small>--</small></p>
@endsection