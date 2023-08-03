@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Third Layer Inspection</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('inspections.sub.third.index', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id]) }}">Back</a>
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

    <form action="{{ route('inspections.sub.third.update', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id, 'third_id' => $thirdlayerinspection->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ASPECT:</strong>
                    <input type="text" name="name" value="{{ $thirdlayerinspection->name }}" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <p class="text-center text-primary"><small>--</small></p>
@endsection
