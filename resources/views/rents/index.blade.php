@extends('layouts.mainLayout')
@section('title','Rents')
@section('content')
    <h1 class="text-center">Rents</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Start date</th>
            <th>Transport</th>
            <th>Tenant</th>
            <th>Rental period</th>
            <th>Owner</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
    {!! $rents->links() !!}
    <a href="{{route('rent.create')}}" class="btn btn-success">Add</a>
@endsection
