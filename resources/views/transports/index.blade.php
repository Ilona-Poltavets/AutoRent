@extends('layouts.mainLayout')
@section('title','Transports')
@section('content')
    <h1 class="text-center">Transports</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Model</th>
            <th>Number</th>
            <th>Mileage</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($transports as $transport)
            <tr>
                <td>{{$transport->id}}</td>
                <td>{{$transport->model}}</td>
                <td>{{$transport->number}}</td>
                <td>{{$transport->mileage}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('transport.show',$transport->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('transport.edit', $transport->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('transport.destroy', $transport->id)}}" method="post">
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
    {!! $transports->links() !!}
    <a href="{{route('currently_rented')}}" class="btn btn-dark">Currently rented</a>
    <a href="{{route('transport.create')}}" class="btn btn-success">Add</a>
@endsection
