@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Group</h2>
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


    <form action="{{ route('groupings.update',$group->id) }}" method="POST">
    	@csrf
        @method('PUT')


       
        <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
		        <div class="form-group">
		            <strong>USER:</strong>
		            <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="users">Select members</label>
                     
                         <select id="user_id" name="user_id">
                            <option value="" disabled selected>Select a member</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
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
                <th class="text-center" width="150px">#</th>
                <th>Name</th>
                <th width="80px">Action</th>
            </tr>
            @foreach ($group->users as $key => $user)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td style="{{ $loop->first ? 'color: blue' : '' }}">{{ $user->name }}</td>
                    <td>
                        <form action="{{ route('groupings.user.destroyUserGroup', ['group' => $group->id, 'user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete: {{ $user->name }}?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    
<p class="text-center text-primary"><small>--</small></p>
@endsection
