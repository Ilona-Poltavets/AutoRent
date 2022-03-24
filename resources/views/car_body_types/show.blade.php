@extends('layouts.mainLayout')
@section('title',$carBodyType->name)
@section('content')
    <table class="table table-dark table-striped table-hover">
        <tr>
            <th colspan="2">
                <div class="row">
                    <a class="btn btn-danger float-right col-1 mx-2" href="{{ URL::previous() }}">Cancel</a>
                    <h5 class="text-center col">{{$carBodyType->name}}</h5>
                </div>
            </th>
        </tr>
        <tr>
            <td>Type</td>
            <td>{{$carBodyType->name}}</td>
        </tr>
    </table>
    <div class="row">
        @foreach($top5 as $transport)
            @php($image=(explode(';',$transport->images))[0])
            <div class="card col" style="max-width: 400px;min-width: 200px">
                <a data-fancybox="single" href="{{asset($image)}}">
                    <img src="{{asset($image)}}" class="card-img-top">
                </a>
                <div class="card-body">
                    <h5>{{$transport->model}}</h5>
                    <a href="{{route('transport.show',$transport->id)}}" class="btn btn-info">Show</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
