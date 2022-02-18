@extends('layouts.mainLayout')
@section('title','Create type')
@section('content')
    <h1 class="text-center">Create car body type</h1>
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
    <form action="{{route('carBodyType.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('car_body_types.form')
    </form>
@endsection
