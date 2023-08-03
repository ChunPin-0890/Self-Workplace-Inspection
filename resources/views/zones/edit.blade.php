@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Zone</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('zones.index') }}"> Back</a>
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


    <form action="{{ route('zones.update',$zone->id) }}" method="POST">
    	@csrf
        @method('PUT')


       
        <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>ZONE:</strong>
		            <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="groups">Select Zone</label>
                     
                         <select id="group_id" name="group_id">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->type }}</option>
                            @endforeach
                         </select>
                     </div>

		        </div>
		    </div>
		  
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Add</button>
		    </div>
		</div>
<br>

    </form>
    <div style="width: 600px; margin: 0 auto;">
    <table class="table table-bordered">
       
        <tr>
        <th>#</th>
        <th>Name</th>
        <th width="80px">Action</th>
        </tr>
        @foreach ($zone->groups as $key => $group)
	    <tr>
	        <td>{{ $key + 1 }}</td>
	        <td>{{ $group->type }}</td>
            <td>
                <form action="{{ route('zones.group.destroyGroup', ['zone' => $zone->id, 'group' => $group->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete: {{ $group->type }}?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
<p class="text-center text-primary"><small>--</small></p>
@endsection