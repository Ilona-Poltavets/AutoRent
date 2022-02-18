@extends('layouts.mainLayout')
@section('title',$tenant->name)
@section('content')
    <table class="table table-dark table-striped table-hover">
        <tr>
            <th colspan="2">
                <div class="row">
                    <a class="btn btn-danger float-right col-1 mx-2" href="{{ URL::previous() }}">Cancel</a>
                    <h5 class="text-center col">{{$tenant->name}}</h5>
                </div>
            </th>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{$tenant->name}}</td>
        </tr>
        <tr>
            <td>Legal entity</td>
            <td>
                @if($tenant->legal_entity==1)
                    Entity
                @elseif($tenant->legal_entity==0)
                    Individual
                @endif
            </td>
        </tr>
    </table>
@endsection
