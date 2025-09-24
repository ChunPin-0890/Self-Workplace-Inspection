@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('plannings.sub.index', ['id' => $parent_planning->id]) }}"> Back</a>
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


    <form action="{{ route('plannings.sub.store',['id' => $parent_planning->id]) }}" method="POST">
    	@csrf
        <input type="hidden" name="planning_id" value="{{ $parent_planning->id }}">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>OPERATING UNIT:</strong>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="oprunits">Select OU</label>
                         <select id="ou_id" name="ou_id"> {{-- name is the database column name to besaved --}}
                            @foreach ($oprs as $opr)
                                <option value="{{ $opr->id }}">{{ $opr->name }}</option>
                            @endforeach
                         </select>
                     </div>
                </div>
       

        
          
              <label for="date">Select a start date:</label>
              <input type="date" class="form-control" id="start_date" name="start_date" required>
              
              <label for="date">Select an end date:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>

    
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>GROUP:</strong>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="groups">Select Group</label>
                         
                             <select id="group_id" name="group_id">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->type }}</option>
                                @endforeach
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


<style>
    /* CSS to change the color of the date input icon */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>
