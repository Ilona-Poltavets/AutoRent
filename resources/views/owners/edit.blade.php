@extends('layouts.mainLayout')
@section('title','Edit owner')
@section('content')
    <h1 class="text-center">Edit owner</h1>
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
    <form method="post" action="{{ route('owner.update',$owner->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('owners.form')
    </form>
@endsection
