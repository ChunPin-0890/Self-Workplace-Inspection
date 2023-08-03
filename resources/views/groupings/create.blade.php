@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Group</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('groupings.index') }}"> Back</a>
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


    <form action="{{ route('groupings.store') }}" method="POST">
    	@csrf


        
        <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		       <label for="groups">Groups</label>
		    
                <select id="groups" name="type">
                    <option value="group_1"> G1</option>
                    <option value="group_2" selected>G2</option>
                    <option value="group_3"> G3</option>
                    <option value="group_4"> G4</option>
                </select>
            </div>

          
            </div>

		 
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Create</button>
		    </div>
		</div>


    </form>


<p class="text-center text-primary"><small>--</small></p>
@endsection