@extends('layouts.app')


@section('content')
<a class="btn btn-primary" href="{{ route('inspections.sub.index',['id' => $parent_inspection->id]) }}">Back</a>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h2>Third Layer Inspections</h2>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                @can('inspection-create')
                    <a class="btn btn-success" href="{{ route('inspections.sub.third.create', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id]) }}">Create New Third Layer Inspection</a>
                @endcan
            </div>
            <div>
                <form action="{{ route('inspections.sub.third.index', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id]) }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control mr-2" placeholder="Search by name" value="{{ $search }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if ($search)
                                <a href="{{ route('inspections.sub.third.index', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id]) }}" class="btn btn-secondary">Clear</a>
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
    @if ($thirdlayerinspections->isNotEmpty())
    <table class="table  table-striped table-bordered table-hover mt-3">
        <tr>
            <th>No</th>
            <th width="800px">ASPECT</th>
           
            <th width="180px">Action</th>
        </tr>
        @foreach ($thirdlayerinspections as $key => $thirdlayerinspection)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>

                <td><b>{{ $thirdlayerinspection->name }}</b></td>
             
                <td>
                    <form action="{{ route('inspections.sub.third.destroy', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id, 'third_id' => $thirdlayerinspection->id]) }}" method="POST">
                        @can('inspection-edit')
                            <a class="btn btn-primary" href="{{ route('inspections.sub.third.edit', ['id' => $parent_inspection->id, 'sub_id' => $subcatinspection->id, 'third_id' => $thirdlayerinspection->id]) }}">Edit</a>
                        @endcan

                        @csrf
                        @method('DELETE')
                        @can('inspection-delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete: {{ $thirdlayerinspection->name }}?')">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @else
    <p class="mt-4">No results found.</p>
@endif
    <p class="text-center text-primary"><small>--</small></p>
@endsection
