@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Third Layer Inspection</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('inspections.sub.third.index', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id]) }}"> Back</a>
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

    <form action="{{ route('inspections.sub.third.store', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id]) }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ASPECT:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type:</strong>
                    <input type="text" name="type" value="{{ $parent_inspection->type }}" class="form-control" readonly>
                </div>
            </div>

            <input type="hidden" name="subcatinspection_id" value="{{ $subcatinspection->id }}">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parent Subcategory Inspection:</strong>
                    <input type="text" value="{{ $subcatinspection->name }}" class="form-control" readonly>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Create Third Layer Inspection</button>
            </div>
        </div>
    </form>

    <p class="text-center text-primary"><small>--</small></p>
@endsection
