@extends('layouts.mainLayout')
@section('title','Tenants')
@section('filters')
    @include('filters.tenantsFilters')
@endsection
@section('content')
    <h1 class="text-center">Tenants</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <input type="text" id="searchTenant" class="form-control search_tenant">
    <table id="table" class="table table-hover">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Legal entity</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="body">
        @foreach($tenants as $tenant)
            <tr>
                <td>{{$tenant->id}}</td>
                <td>{{$tenant->name}}</td>
                <td>
                    @if($tenant->legal_entity==1)
                        Entity
                    @elseif($tenant->legal_entity==0)
                        Individual
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('tenant.show',$tenant->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('tenant.edit', $tenant->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('tenant.destroy',$tenant->id)}}" method="post">
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
    {!! $tenants->links() !!}
    <a href="{{route('tenant.create')}}" class="btn btn-success">Add</a>
    <script>
        function buildTableTenant(tenants) {
            const tbl = document.getElementById('body');
            for (var i = 0; i < tenants.length; i++) {
                var row = `<tr>
                <td>${tenants[i].id}</td>
                <td>${tenants[i].name}</td>
                <td>`;
                if (tenants[i].legal_entity === '1') {
                    row += `Entity`
                } else {
                    row += `Individual`
                }
                row += `</td>
                <td>
                    <div class="btn-group">
                        <a href="tenant/${tenants[i].id}" class="btn btn-info">Show</a>
                        <a href="tenant/${tenants[i].id}/edit" class="btn btn-primary">Edit</a>
                        <form action="owner/${tenants[i].id}" method="post">
                            @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </td>
</tr>`;
                tbl.innerHTML += row;
            }
        }

        $('.search_tenant').bind("change keyup input click", function () {
            $.ajax({
                method: 'POST',
                url: "search/tenant",
                data: {text_input: $(this).val(), _token: '{{csrf_token()}}'},
                success: function (data) {
                    $("#table tbody tr").remove();
                    buildTableTenant(data);
                }
            })
        })
    </script>
@endsection
