@extends('layouts.mainLayout')
@section('title',$country->name)
@section('content')
    <table class="table table-dark table-striped table-hover">
        <tr>
            <th colspan="2">
                <div class="row">
                    <a class="btn btn-danger float-right col-1 mx-2" href="{{ URL::previous() }}">Cancel</a>
                    <h5 class="text-center col">{{$country->name}}</h5>
                </div>
            </th>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{$country->name}}</td>
        </tr>
        <tr>
            <td>Continent</td>
            <td>{{$country->continent}}</td>
        </tr>
        <tr>
            <td>Flag</td>
            <td><img src="{{asset($country->flag)}}" alt="{{$country->name}}" class="flag"></td>
        </tr>
    </table>
@endsection
