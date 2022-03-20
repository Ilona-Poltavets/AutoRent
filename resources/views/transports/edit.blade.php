@extends('layouts.mainLayout')
@section('title','Edit transport')
@section('content')
    <h1 class="text-center">Edit transport</h1>
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
    <form method="post" action="{{ route('transport.update',$transport->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('transports.form')
    </form>
@endsection
