@extends('layouts.mainLayout')
@section('title','Rents')
@section('filters')
    @include('filters.rentsFilters')
@endsection
@section('content')
    <h1 class="text-center">Rents</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <input type="text" class="form-control search_rent">
    <table id="table" class="table table-hover">
        <thead>
        <tr>
            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <th>#</th>
            @endif
            <th>Start date</th>
            <th>Transport</th>
            <th>Tenant</th>
            <th>Rental period</th>
            <th>Owner</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="body">
        @foreach($rents as $rent)
            <tr>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <td>{{$rent->id}}</td>
                @endif
                <td>{{$rent->date}}</td>
                <td>{{\App\Models\Transport::find($rent->id_transport)->model}}</td>
                <td>{{\App\Models\Tenant::find($rent->id_tenant)->name}}</td>
                <td>{{$rent->rental_period}}</td>
                <td>{{\App\Models\Owner::find($rent->id_owner)->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('rent.show',$rent->id)}}" class="btn btn-info">Show</a>
                        @auth()
                            @if(\Illuminate\Support\Facades\Auth::user()->can('edit',\App\Models\Rent::class))
                                <a href="{{route('rent.edit', $rent->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->can('delete',\App\Models\Rent::class))
                                <form action="{{route('rent.destroy', $rent->id)}}" method="post">
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
    {!! $rents->links() !!}
    <script>
        function buildRentsTable(rents) {
            const tbl = document.getElementById('body');
            for (var i = 0; i < rents.length; i++) {
                var row = `
                    <tr>
                    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <td>${rents[i].id}</td>
                @endif
                <td>${rents[i].date}</td>
                <td>${rents[i].model}</td>
                <td>${rents[i].tenant}</td>
                <td>${rents[i].rental_period}</td>
                <td>${rents[i].owner}</td>
                <td>
                    <div class="btn-group">
                        <a href="rents/${rents[i].id}" class="btn btn-info">Show</a>
                        @auth()
                @if(\Illuminate\Support\Facades\Auth::user()->can('edit',\App\Models\Rent::class))
                        <a href="rents/${rents[i].id}/edit" class="btn btn-primary">Edit</a>
                        @endif
                @if(\Illuminate\Support\Facades\Auth::user()->can('delete',\App\Models\Rent::class))
                        <form action="rents/${rents[i].id}" method="post">
                            @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endif
                @endauth
        </div>
    </td>
</tr>
`
                tbl.innerHTML += row;
            }
        }

        $('.search_rent').bind("change keyup input click", function () {
            $.ajax({
                method: 'POST',
                url: "search/rent",
                data: {text_input: $(this).val(), _token: '{{csrf_token()}}'},
                success: function (data) {
                    $("#table tbody tr").remove();
                    buildRentsTable(data);
                }
            });
        });
    </script>
@endsection
