@extends('layouts.mainLayout')
@section('title','Edit car body type')
@section('content')
    <h1 class="text-center">Edit car body type</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('carBodyType.update',$carBodyType->id) }}" >
        @method('PATCH')
        @csrf
        @include('car_body_types.form')
    </form>
@endsection
