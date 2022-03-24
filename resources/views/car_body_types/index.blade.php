@extends('layouts.mainLayout')
@section('title','Car body Types')
@section('content')
    <h1 class="text-center">Car body types</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Type</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr>
                <td>{{$type->id}}</td>
                <td>{{$type->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('carBodyType.show',$type->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('carBodyType.edit', $type->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('carBodyType.destroy',$type->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{route('carBodyType.create')}}" class="btn btn-success">Add</a>
@endsection
