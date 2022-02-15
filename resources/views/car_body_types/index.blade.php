@extends('layouts.mainLayout')
@section('title','Transports')
@section('content')
    <h1 class="text-center">Car body types</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Type</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($carBodyTypes as $type)
            <tr>
                <td>{{$type->id}}</td>
                <td>{{$type->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('carBodyType.show',$type->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('carBodyType.edit', $type->id)}}" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{route('carBodyType.create')}}" class="btn btn-success">Add</a>
@endsection
