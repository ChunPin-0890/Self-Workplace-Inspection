@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Inspection</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('inspections.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Details</th>
           
          
            <th width="280px">Action</th>
        </tr>
        <tr>
            
                 <td>{{ $inspection->name }}</td>
            
	        <td>{{ $inspection->detail }}</td>
            
            
        </tr>
           
    </div>
    
@endsection

<p class="text-center text-primary"><small>--</small></p>