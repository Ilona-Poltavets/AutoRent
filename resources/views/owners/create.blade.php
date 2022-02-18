@extends('layouts.mainLayout')
@section('title','Create owner')
@section('content')
    <h1 class="text-center">Create owner</h1>
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
    <form action="{{route('owner.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('owners.form')
    </form>
@endsection
