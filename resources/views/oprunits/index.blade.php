@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Operating Unit</h2>
            </div>
            <div class="pull-right">
                @can('inspection-create')
                <a class="btn btn-success" href="{{ route('oprunits.create') }}"> Create new Operating Unit</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-striped table-bordered mt-3">
        <tr>
               
            <th>No</th>
          <th>Name</th>
          <th>Type</th>
            <th width="280px">Action</th>
            </tr>
	    @foreach ($oprunits as $oprunit)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $oprunit->name}}</td>
            <td>{{ $oprunit->type}}</td>
	        <td>
                <form action="{{ route('oprunits.destroy',$oprunit->id) }}" method="POST">
    
                    @can('inspection-edit')
                    <a class="btn btn-primary" href="{{ route('oprunits.edit',$oprunit->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('inspection-delete')
                    <button type="submit" class="btn btn-danger"onclick="return confirm('Are you sure you want to delete: {{ $oprunit->name }}?')">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $oprunits->links() !!}
    

<p class="text-center text-primary"><small>--</small></p>
@endsection