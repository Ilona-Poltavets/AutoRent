@extends('layouts.mainLayout')
@section('title',$rent->model)
@section('content')
    <table class="table table-dark table-striped table-hover">
        <tr>
            <th colspan="2">
                <div class="row">
                    <a class="btn btn-danger float-right col-1 mx-2" href="{{ URL::previous() }}">Cancel</a>
                    <h5 class="text-center col">{{$rent->name}}</h5>
                </div>
            </th>
        </tr>
        <tr>
            <td>Date</td>
            <td>{{$rent->date}}</td>
        </tr>
        <tr>
            <td>Rental period</td>
            <td>{{$rent->rental_period}}</td>
        </tr>
        <tr>
            <td>Transport</td>
            <td>{{App\Models\Transport::find($rent->id_transport)->model}}</td>
        </tr>
        <tr>
            <td>Owner</td>
            <td>{{App\Models\Owner::find($rent->id_owner)->name}}</td>
        </tr>
        <tr>
            <td>Tenant</td>
            <td>{{App\Models\Tenant::find($rent->id_tenant)->name}}</td>
        </tr>
    </table>
@endsection
