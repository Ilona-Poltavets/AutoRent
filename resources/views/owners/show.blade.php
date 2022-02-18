@extends('layouts.mainLayout')
@section('title',$owner->name)
@section('content')
    <table class="table table-dark table-striped table-hover">
        <tr>
            <th colspan="2">
                <div class="row">
                    <a class="btn btn-danger float-right col-1 mx-2" href="{{ URL::previous() }}">Cancel</a>
                    <h5 class="text-center col">{{$owner->name}}</h5>
                </div>
            </th>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{$owner->name}}</td>
        </tr>
    </table>
@endsection
