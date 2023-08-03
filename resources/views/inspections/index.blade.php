@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h2>Inspections</h2>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                @can('inspection-create')
                    <a class="btn btn-success" href="{{ route('inspections.create') }}">Create New Inspection</a>
                @endcan
            </div>
            <div>
                <form action="{{ route('inspections.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control mr-2" placeholder="Search by name" value="{{ $search }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if ($search)
                                <a href="{{ route('inspections.index') }}" class="btn btn-secondary">Clear</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($inspections->isNotEmpty())
    <table class="table  table-striped table-bordered table-hover mt-3">
        <tr>
            <th style="text-align: center;" width="100px">No</th>
            <th width="450px">ASPECT</th>
            <th>Type</th>
            <th width="260px">Action</th>
        </tr>
        @foreach ($inspections as $key => $inspection)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td><b>{{ $inspection->name }}</b></td>
                <td>{{ $inspection->type }}</td>
                <td>
                    <form action="{{ route('inspections.destroy', $inspection->id) }}" method="POST">
                        @can('inspection-edit')
                            <a class="btn btn-primary" href="{{ route('inspections.edit', $inspection->id) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('inspection-delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete: {{ $inspection->name }}?')">Delete</button>
                        @endcan
                        <a href="{{ route('inspections.sub.index', $inspection->id) }}" class="btn btn-primary" style="background-color: orange">Subcategory</a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @else
    <p class="mt-4">No results found.</p>
@endif
    {!! $inspections->appends(['search' => $search])->links() !!}

    <p class="text-center text-primary"><small>--</small></p>
@endsection
