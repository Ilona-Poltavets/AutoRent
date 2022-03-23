@extends('layouts.mainLayout')
@section('title',$transport->model)
@section('content')
    <table class="table table-dark table-striped table-hover">
        <tr>
            <th colspan="2">
                <div class="row">
                    <a class="btn btn-danger float-right col-1 mx-2" href="{{ URL::previous() }}">Cancel</a>
                    <h5 class="text-center col">{{$transport->model}}</h5>
                </div>
            </th>
        </tr>

        <tr>
            <th colspan="2">
                @php($images=explode(';',$transport->images))
                @foreach($images as $image)
                    <img src="{{asset($image)}}" class="miniPhoto">
                @endforeach
            </th>
        </tr>

        <tr>
            <td>Model</td>
            <td>{{$transport->model}}</td>
        </tr>

        <tr>
            <td>Body type</td>
            <td>{{App\Models\CarBodyType::find($transport->body_type_id)->name}}</td>
        </tr>

        <tr>
            <td>Number</td>
            <td>{{$transport->number}}</td>
        </tr>

        <tr>
            <td>Owner</td>
            <td>{{App\Models\Owner::find($transport->owner_id)->name}}</td>
        </tr>

        <tr>
            <td>Country</td>
            <td>{{App\Models\Tenant::find($transport->country_id)->name}}</td>
        </tr>

        <tr>
            <td>Mileage</td>
            <td>{{$transport->mileage}}</td>
        </tr>
    </table>
    <div class="btn-group">
        <a href="{{route('transport.edit',$transport->id)}}" class="btn btn-primary">Edit</a>
        <form action="{{route('transport.destroy',$transport->id)}}" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a class="btn btn-success" href="{{route('rent.create',$transport->id)}}">Rent</a>
    </div>
@endsection
