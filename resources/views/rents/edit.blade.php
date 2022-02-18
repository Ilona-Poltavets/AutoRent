@extends('layouts.mainLayout')
@section('title','Edit rent')
@section('content')
    <h1 class="text-center">Edit rent</h1>
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
    <form method="post" action="{{ route('rent.update',$rent->id) }}" >
        @method('PATCH')
        @csrf
        @include('rents.form')
    </form>
@endsection
