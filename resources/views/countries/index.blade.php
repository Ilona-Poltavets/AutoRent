@extends('layouts.mainLayout')
@section('title','Countries')
@section('filters')
    @include('filters.countriesFilter')
@endsection
@section('content')
    <h1 class="text-center">Countries</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <table id="table" class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Continent</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($countries as $country)
            <tr>
                <td>{{$country->id}}</td>
                <td>{{$country->name}}</td>
                <td>{{$country->continent}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('country.show',$country->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('country.edit', $country->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('country.destroy', $country->id)}}" method="post">
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
    {!! $countries->links() !!}
    <a href="{{route('country.create')}}" class="btn btn-success">Add</a>
    <script>
        function buildCountryTable(countries) {
            const tbl = document.getElementById('table');
            for (var i = 0; i < countries.length; i++) {
                var row = `<tr>
							<td>${countries[i].id}</td>
							<td>${countries[i].name}</td>
							<td>${countries[i].continent}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="country/${countries[i].id}" class="btn btn-info">Show</a>
                                    <a href="country/${countries[i].id}/edit" class="btn btn-primary">Edit</a>
                                    <form action="country/${countries[i].id}" method="post">
                                        @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </td>
    </tr>`
                tbl.innerHTML += row
            }
        }
    </script>
@endsection
