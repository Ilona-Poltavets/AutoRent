@extends('layouts.mainLayout')
@section('title','Tenants')
@section('content')
    <h1 class="text-center">Tenants</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Legal entity</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tenants as $tenant)
            <tr>
                <td>{{$tenant->id}}</td>
                <td>{{$tenant->name}}</td>
                <td>
                    @if($tenant->legal_entity==1)
                        Entity
                    @elseif($tenant->legal_entity==0)
                        Individual
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('tenant.show',$tenant->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('tenant.edit', $tenant->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('tenant.destroy',$tenant->id)}}" method="post">
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
    {!! $tenants->links() !!}
    <a href="{{route('tenant.create')}}" class="btn btn-success">Add</a>
@endsection
