@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Checklist</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('plannings.sub.execution.index', ['id' => $sub_planning->parent->id, 'sub_id' => $sub_planning->id]) }}"> Back</a>
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
    <form action="{{ route('plannings.sub.execution.update', ['id' => $id, 'sub_id' => $sub_id, 'execution_id' => $execution->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Edit user:</strong>
                <input type="hidden" name="subplanning_id" value="{{ $sub_planning->id }}">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="user_id">Select User</label>
                    <select id="user_id" name="user_id">
                        @foreach ($sub_planning->groups->first()->users as $user)
                            <option value="{{ $user->id }}" {{ $execution->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div style="width: 900px; margin: 0 auto; overflow-x: auto;">
            <table class="table table-bordered">
                <tr>   
                    <th>#</th>
                    <th width="200px">Name</th>
                    <th>Status</th>
                    <th>Comment</th>
                </tr>

                @foreach ($executionChildren as $key => $child)
                    
                <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $child->name }}</td>

                        <td>
                            <input type="radio" name="status[{{ $child->id }}]" value="100" {{ $executions[$child->id]['status'] == 100 ? 'checked' : '' }}> Good<br>
                            <input type="radio" name="status[{{ $child->id }}]" value="50" {{ $executions[$child->id]['status']== 50 ? 'checked' : '' }}> Not good<br>
                            <input type="radio" name="status[{{ $child->id }}]" value="0" {{  $executions[$child->id]['status'] == 0 ? 'checked' : '' }}> Irrelevant
                        </td>
                        <td>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" style="height:150px" name="comment[{{ $child->id }}]" placeholder="Comment">{{$executions[$child->id]['comment'] }}</textarea>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @foreach ($child->children as $index => $grandChild)
                        <tr>
                            <td>{{ chr(65 + $index) }}</td>
                            <td>{{ $grandChild->name }}</td>
                          
                            <td>
                                <input type="radio" name="status[{{ $grandChild->id }}]" value="100" {{ $executions[$grandChild->id]['status']  == 100 ? 'checked' : '' }}> Good<br>
                                <input type="radio" name="status[{{ $grandChild->id }}]" value="50" {{$executions[$grandChild->id]['status']  == 50 ? 'checked' : '' }}> Not good<br>
                                <input type="radio" name="status[{{ $grandChild->id }}]" value="0" {{ $executions[$grandChild->id]['status'] == 0 ? 'checked' : '' }}> Irrelevant
                            </td>
                            <td>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" style="height:150px" name="comment[{{ $grandChild->id }}]" placeholder="Comment">{{ $executions[$grandChild->id]['comment']  }}</textarea>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

    <p class="text-center text-primary"><small>--</small></p>
@endsection
