@extends('layouts.mainLayout')
@section('title','Owners')
@section('content')
    <h1 class="text-center">Owners</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($owners as $owner)
            <tr>
                <td>{{$owner->id}}</td>
                <td>{{$owner->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('owner.show',$owner->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('owner.edit', $owner->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('owner.destroy', $owner->id)}}" method="post">
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
    {!! $owners->links() !!}
    <a href="{{route('owner.create')}}" class="btn btn-success">Add</a>
@endsection
