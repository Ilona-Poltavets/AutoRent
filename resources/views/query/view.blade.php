@extends('layouts.mainLayout')
@section('title','View')
@section('content')
    <h5 class="text-center">Currently rented</h5>
    <table class="table table-dark table-stripped table-hover">
        <thead>
        <tr>
            <th>Car</th>
            <th>Owner</th>
            <th>Tenant</th>
            <th>end_date_rent</th>
        </tr>
        </thead>
        <tbody>
        @foreach($table as $row)
        <tr>
            <td>{{$row->model}}</td>
            <td>{{$row->owner}}</td>
            <td>{{$row->tenant}}</td>
            <td>{{$row->end_date_rent}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
