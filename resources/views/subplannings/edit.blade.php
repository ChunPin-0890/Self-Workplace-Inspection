@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit </h2>
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


    <form action="{{ route('plannings.sub.update',[$parent_planning->id, $sub_planning->id]) }}" method="POST">
    	@csrf
        @method('PUT')
        <input type="hidden" name="planning_id" value="{{ $parent_planning->id }}">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>OPERATING UNIT:</strong>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="ou_id">Select OU</label>
                        <select id="ou_id" name="ou_id" disabled>
                            @foreach ($oprs as $opr)
                                <option value="{{ $opr->id }}" {{ $sub_planning->ou_id == $opr->id ? 'selected' : '' }}>
                                    {{ $opr->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <label for="start_date">Select a start date:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required value="{{ $sub_planning->start_date }}">
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <label for="end_date">Select an end date:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required value="{{ $sub_planning->end_date }}">
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>GROUP:</strong>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="group_id">Select Group</label>
                    <select id="group_id" name="group_id">
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ $sub_planning->group_id == $group->id ? 'selected' : '' }}>
                                {{ $group->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
	

           
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Update</button>
		   
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
