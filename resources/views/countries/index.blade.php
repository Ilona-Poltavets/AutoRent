@extends('layouts.mainLayout')
@section('title','Countries')
@section('content')
    <h1 class="text-center">Countries</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($countries as $country)
            <tr>
                <td>{{$country->id}}</td>
                <td>{{$country->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('country.show',$country->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('country.edit', $country->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('country.destroy', $country->id)}}" method="post">
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
    {!! $countries->links() !!}
    <a href="{{route('country.create')}}" class="btn btn-success">Add</a>
@endsection
