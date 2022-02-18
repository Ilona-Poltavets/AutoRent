@extends('layouts.mainLayout')
@section('title','Edit tenant')
@section('content')
    <h1 class="text-center">Edit tenant</h1>
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
    <form method="post" action="{{ route('tenant.update',$tenant->id) }}" >
        @method('PATCH')
        @csrf
        @include('tenants.form')
    </form>
@endsection
