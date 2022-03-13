@extends('layouts.mainLayout')
@section('title','Transports')
@section('content')
    <h1 class="text-center">Transports</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <input class="search_transport form-control" type="text">
    <table id="table" class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Model</th>
            <th>Number</th>
            <th>Mileage</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    {!! $transports->links() !!}
    <a href="{{route('currently_rented')}}" class="btn btn-dark">Currently rented</a>
    <a href="{{route('transport.create')}}" class="btn btn-success">Add</a>
    <script>
        var transportsJSON = <?php echo json_encode($transports); ?>;
        var transportsStart = transportsJSON.data;

        function buildTable(transports) {
            const tbl = document.getElementById('table');
            for (var i = 0; i < transports.length; i++) {
                var row = `<tr>
							<td>${transports[i].id}</td>
							<td>${transports[i].model}</td>
							<td>${transports[i].number}</td>
                            <td>${transports[i].mileage}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="@{{route('transport.show',${transports[i].id})}}" class="btn btn-info">Show</a>
                                    <a href="@{{route('transport.edit', ${transports[i].id})}}" class="btn btn-primary">Edit</a>
                                    <form action="@{{route('transport.destroy', ${transports[i].id})}}" method="post">
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
        buildTable(transportsStart);

        $('.search_transport').bind("change keyup input click", function () {
            if ($(this).val().length > 0) {
                $.ajax({
                    method: 'POST',
                    url: "{{url('search/transport')}}",
                    data: {text_input: $(this).val(), _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $("#table tbody tr").remove();
                        buildTable(data);
                    }
                });
            }
        });
    </script>
@endsection
