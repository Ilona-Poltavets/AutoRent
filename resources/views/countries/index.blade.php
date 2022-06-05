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
    <input class="search_country form-control" type="text">
    <table id="table" class="table table-hover">
        <thead class="table-dark">
        <tr>
            <th width="250">Flag</th>
            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <th>#</th>
            @endif
            <th>Name</th>
            <th>Continent</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($countries as $country)
            <tr>
                <td><img src="{{asset($country->flag)}}" alt="{{$country->name}}" class="flag"></td>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <td>{{$country->id}}</td>
                @endif
                <td>{{$country->name}}</td>
                <td>{{$country->continent}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('country.show',$country->id)}}" class="btn btn-info">Show</a>
                        @auth()
                            @if(\Illuminate\Support\Facades\Auth::user()->can('edit',\App\Models\Country::class))
                                <a href="{{route('country.edit', $country->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->can('delete',\App\Models\Country::class))
                                <form action="{{route('country.destroy', $country->id)}}" method="post">
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
    {!! $countries->links() !!}
    @if(Auth::user() && \Illuminate\Support\Facades\Auth::user()->can('create',\App\Models\Country::class))
        <a href="{{route('country.create')}}" class="btn btn-success">Add</a>
    @endif
    <script>
        function buildCountryTable(countries) {
            const tbl = document.getElementById('table');
            for (var i = 0; i < countries.length; i++) {
                var row = `<tr>
                            <td><img src="${countries[i].flag}" alt="${countries[i].name}" class="flag"></td>
                            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <td>${countries[i].id}</td>
							@endif
                <td>${countries[i].name}</td>
							<td>${countries[i].continent}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="country/${countries[i].id}" class="btn btn-info">Show</a>
                                    @auth()
                @if(\Illuminate\Support\Facades\Auth::user()->can('edit',\App\Models\Country::class))
                <a href="country/${countries[i].id}/edit" class="btn btn-primary">Edit</a>
                                    @endif
                @if(\Illuminate\Support\Facades\Auth::user()->can('delete',\App\Models\Country::class))
                <form action="country/${countries[i].id}" method="post">
                                        @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endif
                @endauth
                </div>
            </td>
            </tr>`
                tbl.innerHTML += row
            }
        }

        $('.search_country').bind("change keyup input click", function () {
            $.ajax({
                method: "POST",
                url: "search/country",
                data: {text_input: $(this).val(), _token: '{{csrf_token()}}'},
                success: function (data) {
                    $("#table tbody tr").remove();
                    buildCountryTable(data);
                }
            })
        })
    </script>
@endsection
