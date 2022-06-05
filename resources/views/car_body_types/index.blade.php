@extends('layouts.mainLayout')
@section('title','Car body Types')
@section('content')
    <h1 class="text-center">Car body types</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-dark">
        <tr>
            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <th>#</th>
            @endif
            <th>Type</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <td>{{$type->id}}</td>
                @endif
                <td>{{$type->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('carBodyType.show',$type->id)}}" class="btn btn-info">Show</a>
                        @auth()
                            @if(\Illuminate\Support\Facades\Auth::user()->can('edit',\App\Models\CarBodyType::class))
                                <a href="{{route('carBodyType.edit', $type->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->can('delete',\App\Models\CarBodyType::class))
                                <form action="{{route('carBodyType.destroy',$type->id)}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->can('create',\App\Models\CarBodyType::class))
        <a href="{{route('carBodyType.create')}}" class="btn btn-success">Add</a>
    @endif
@endsection
