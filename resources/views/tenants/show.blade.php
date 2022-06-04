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
    <table class="table table-dark table-striped table-hover">
        <tr>
            <td colspan="7">
                <h5 class="text-center">History of rent</h5>
            </td>
        </tr>
        @foreach($rents as $rent)
            <tr>
                <td>{{$rent->id}}</td>
                <td>{{$rent->date}}</td>
                <td>{{\App\Models\Transport::find($rent->id_transport)->model}}</td>
                <td>{{\App\Models\Tenant::find($rent->id_tenant)->name}}</td>
                <td>{{$rent->rental_period}}</td>
                <td>{{\App\Models\Owner::find($rent->id_owner)->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('rent.show',$rent->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('rent.edit', $rent->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('rent.destroy', $rent->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
