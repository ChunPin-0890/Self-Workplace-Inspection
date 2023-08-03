@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Planning</h2>
            </div>
            <div class="pull-right">
                @can('inspection-create')
                <a class="btn btn-success" href="{{ route('plannings.create') }}"> Create Planning</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table  table-striped able-bordered table-hover mt-3">
        <tr>
            <th  style="text-align: center">No</th>
          
              
            <th>Name</th>
            
            <th>Year</th>
          
            
            <th width="280px">Action</th>
            </tr>
	     @foreach ($plannings as $key => $planning)
	    <tr>
            
	        <td style="text-align: center;">{{ $key + 1 }}</td>
	        <td>{{ $planning->name}}</td>
	        <td>{{ $planning->year }}</td>
           
	        <td>
                <form action="{{ route('plannings.destroy',$planning->id) }}" method="POST">
                   
                    @can('inspection-edit')
                    <a class="btn btn-primary" href="{{ route('plannings.edit',$planning->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('inspection-delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete: {{ $planning->name }}?')">Delete</button>
                    @endcan
                    <a href="{{ route('plannings.sub.index',$planning->id) }}" class="btn btn-primary" style="background-color: orange">Schedule</a>
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


   
    

<p class="text-center text-primary"><small>--</small></p>
@endsection