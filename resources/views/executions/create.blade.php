@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Checklist</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('plannings.sub.execution.index', ['id' => $sub_planning->parent->id, 'sub_id' => $sub_planning->id,]) }}"> Back</a>
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


    <form action="{{ route('plannings.sub.execution.store', ['id' => $sub_planning->parent->id, 'sub_id' => $sub_planning->id]) }}" method="POST">
    	@csrf


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Inspection:</strong>
                    <input type="hidden" name="subplanning_id" value="{{ $sub_planning->id }}">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="inspections">Select Item</label>
                        
                        <select id="inspection_id" name="inspection_id"> {{-- name is the database column name to besaved --}}
                            @foreach ($inspections as $inspection)
                                <option value="{{ $inspection->id }}">{{ $inspection->name }}</option>
                            @endforeach
                         </select>
                     </div>
                     
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Assign to user:</strong>
                    <input type="hidden" name="subplanning_id" value="{{ $sub_planning->id }}">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="inspections">Select User</label>
                        
                        <select id="user_id" name="user_id"> {{-- name is the database column name to besaved --}}
                            @foreach ($sub_planning?->groups?->first()?->users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
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