@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Inspection</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('groupings.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>JAN-MAR:</strong>
                {{ $grouping->season1 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>APR-JUN:</strong>
                {{ $grouping->season2 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>JUL-SEP:</strong>
                {{ $grouping->season3 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>OCT-DEC:</strong>
                {{ $grouping->season4 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {{ $grouping->description }}
        </div>
    </div>
    </div>
    
</div>
@endsection
<p class="text-center text-primary"><small>--</small></p>