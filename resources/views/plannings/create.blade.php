@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('plannings.index') }}"> Back</a>
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


    <form action="{{ route('plannings.store') }}" method="POST">
    	@csrf


        
        <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Programme name:</strong>
		            <input type="text" name="name" class="form-control">
		        </div>
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <strong>year:</strong>
		    <select name="year">
                @php
                    $currentYear = date('Y');
                    $startYear = $currentYear - 10;
                    $endYear = $currentYear + 10;
                @endphp
                
                @for ($year = $startYear; $year <= $endYear; $year++)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
            </div>
            
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Create</button>
		    </div>
		</div>


    </form>


<p class="text-center text-primary"><small>--</small></p>
@endsection