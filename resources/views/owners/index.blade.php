@extends('layouts.mainLayout')
@section('title','Owners')
@section('filters')
    @include('filters.ownersFilter')
@endsection
@section('content')
    <script>
        let colors = ["#049372", "#4183D7", "#D2527F", "#E87E04", "#8E44AD"];
    </script>
    <h1 class="text-center">Owners</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <input type="text" id="searchOwner" class="form-control search_owner">
    <table id="table" class="table table-hover">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th width="350">logo</th>
            <th>name</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="body">
        @foreach($owners as $owner)
            <tr>
                <td>{{$owner->id}}</td>
                @if($owner->logo!=null)
                    <td align="center">
                        <img src="{{asset($owner->logo)}}" height="60">
                    </td>
                @else
                    <td id="{{$owner->name}}"
                        style="color: white;text-align: center;font-family: 'GaliverSans';font-weight: bold">
                        {{$owner->name}}
                    </td>
                    <script>
                        document.getElementById("<?php echo $owner->name?>").style.backgroundColor = colors[Math.floor(Math.random() * 5)];
                    </script>
                @endif
                <td align="center">{{$owner->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('owner.show',$owner->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('owner.edit', $owner->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('owner.destroy', $owner->id)}}" method="post">
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
    {!! $owners->links() !!}
    <a href="{{route('owner.create')}}" class="btn btn-success">Add</a>
    <script>
        function buildTableOwner(owners) {
            const tbl = document.getElementById('body');
            for (var i = 0; i < owners.length; i++) {
                var row = `<tr><td>${owners[i].id}</td>`;
                if (owners[i].logo != null) {
                    row += `<td align="center">
                        <img src="${owners[i].logo}" height="60">
                    </td>`;
                } else {
                    row += `<td id="${owners[i].name}"
                        style="color: white;text-align: center;font-family: 'GaliverSans';font-weight: bold; background-color:${colors[Math.floor(Math.random() * 5)]}">
                        ${owners[i].name}
                    </td>`;
                }
                row += `<td align="center">${owners[i].name}</td>
                <td>
                    <div class="btn-group">
                        <a href="owner/${owners[i].id}" class="btn btn-info">Show</a>
                        <a href="owner/${owners[i].id}/edit" class="btn btn-primary">Edit</a>
                        <form action="owner/${owners[i].id}" method="post">
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

        $('.search_owner').bind("change keyup input click", function () {
            $.ajax({
                method: 'POST',
                url: "search/owner",
                data: {text_input: $(this).val(), _token: '{{csrf_token()}}'},
                success: function (data) {
                    $("#table tbody tr").remove();
                    buildTableOwner(data);
                }
            })
        })
    </script>
@endsection
