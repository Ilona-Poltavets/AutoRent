@extends('layouts.mainLayout')
@section('title','Create tenant')
@section('content')
    <h1 class="text-center">Create tenant</h1>
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
    <form action="{{route('tenant.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('tenants.form')
    </form>
@endsection
