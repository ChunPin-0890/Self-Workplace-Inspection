@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('subcategory.index') }}"> Back</a>
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
		            <strong>PERKARA:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
            <div class="input-group">
                <label><b>Compliance status: </b></label>
           <br> <select name="status" id="status" class="form-control" >
                        <option value="-" >None</option>
                       <option value="100%" >100%</option>
                       <option value="50%">50%</option>
                       <option value="0%">0%</option>
                    </select> 
              </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>KOMEN:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
		        </div>
		    </div>
         

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Parent Inspection:</strong>
		            <select name="parent_id" id="parent_id" >
                        <option value="0">Select</option>
                        @foreach($inspections as $inspection)
                            <option value="{{ $inspection->id }}">{{ $inspection->name }}</option>
                        @endforeach
                    </select>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


<p class="text-center text-primary"><small></small></p>
@endsection