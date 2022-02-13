@extends('layouts.mainLayout')
@section('title','Transports')
@section('content')
    <h1 class="text-center">Transports</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table">
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
                        <a href="{{route('transport.edit', $transport->id)}}" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{route('transport.create')}}" class="btn btn-success">Add</a>
@endsection
