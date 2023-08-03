@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('inspections.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('inspections.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>ASPECT:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
        
          
           <div class="col-xs-12 col-sm-12 col-md-12">
            <label for="type">Type</label>
         
             <select id="type" name="type">
                 <option value="Ladang"> Ladang</option>
                 <option value="Kilang" selected>Kilang</option>
             </select>
         </div>

		   
         
            <style>
                .indented-option {
                    margin-left: 10px; /* Adjust the margin value as per your needs */
                }
            </style>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Parent Inspection:</strong>
                <select name="parent_id" id="parent_id" readonly>
                    <option value="0">No Parent</option>
                </select>
            </div>
        </div>
        
        
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


<p class="text-center text-primary"><small>--</small></p>
@endsection