@extends('layouts.mainLayout')
@section('title','Transports')
@section('filters')
    @include('filters.transportsFilters')
@endsection
@section('content')
    <script>let index;</script>
    <h1 class="text-center">Transports</h1>
    @if (!empty($success))
        <div class="alert alert-success">
            {{$success}}
        </div>
    @endif
    <input class="search_transport form-control" type="text">
    <table id="table" class="table table-striped">
        <thead class="table-dark">
        <tr>
            <th width="300"></th>
            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <th>#</th>
            @endif
            <th>Model</th>
            <th>Number</th>
            <th>Mileage</th>
            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <th>Mumber of leases</th>
            @endif
            <th width="100"></th>
        </tr>
        </thead>
        <tbody id="body">
        @foreach($transports as $index=>$transport)
            @php($images=explode(';',$transport->images))
            <tr>
                <td rowspan="2">
                    <a data-fancybox="single" href="{{asset($images[0])}}">
                        <img src="{{asset($images[0])}}" alt="{{$transport->model}}" class="photo single-images">
                    </a>
                </td>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <td>{{$transport->id}}</td>
                @endif
                <td>{{$transport->model}}</td>
                <td>{{$transport->number}}</td>
                <td>{{$transport->mileage}}</td>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <td>{{$transport->amount_in_rent}}</td>
                @endif
                <td>
                    <div class="btn-group">
                        <a href="{{route('transport.show',$transport->id)}}" class="btn btn-info">Show</a>
                        @auth()
                            @if(Auth::user()->can('edit',\App\Models\Transport::class))
                                <a href="{{route('transport.edit',$transport->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                            @if(Auth::user()->can('delete',\App\Models\Transport::class))
                                <form action="{{route('transport.destroy',$transport->id)}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div id="group{{$index}}" class="pb-8 flex flex-wrap gap-5 justify-center max-w-5xl mx-auto px-6">
                        @foreach($images as $index2=>$image)
                            @if($index2!=0)
                                <a href="{{asset($image)}}" data-fancybox="gallery">
                                    <img src="{{asset($image)}}" class="miniPhoto">
                                </a>
                            @endif
                        @endforeach
                    </div>
                </td>
            </tr>
            <script>
                index =<?php echo $index?>;
                Fancybox.bind("#group" + index + " a", {});
            </script>
        @endforeach
        </tbody>
    </table>
    {!! $transports->links() !!}
    <a href="{{route('currently_rented')}}" class="btn btn-dark">Currently rented</a>
    @if(Auth::user() && Auth::user()->can('create',\App\Models\Transport::class))
        <a href="{{route('transport.create')}}" class="btn btn-success">Add</a>
    @endif
    <script>
        function buildTableTransport(transports) {
            const tbl = document.getElementById('body');
            for (var i = 0; i < transports.length; i++) {
                var images = (transports[i].images).split(';');
                var row = `<tr>
                <td rowspan="2"><a data-fancybox="single" href="${images[0]}">
                <img src="${images[0]}" alt="${transports[i].model}" class="photo">
                </a></td>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <td>${transports[i].id}</td>
                 @endif
                <td>${transports[i].model}</td>
                <td>${transports[i].number}</td>
                <td>${transports[i].mileage}</td>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <td>${transports[i].amount_in_rent}</td>
                @endif
                <td>
                                <div class="btn-group">
                                    <a href="transport/${transports[i].id}" class="btn btn-info">Show</a>
                                    @if(Auth::user() && Auth::user()->can('edit',Transport::class))
                <a href="transport/${transports[i].id}/edit" class="btn btn-primary">Edit</a>
                                    @endif
                @if(Auth::user() && Auth::user()->can('delete',Transport::class))
                <form action="transport/${transports[i].id}" method="post">
                                            @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
@endif
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6">
            <div id="group${i}" class="pb-8 flex flex-wrap gap-5 justify-center max-w-5xl mx-auto px-6">`;
                for (var j = 1; j < images.length; j++) {
                    row += `<a href="${images[j]}" data-fancybox="gallery"><img src="${images[j]}" class="miniPhoto"></a>`
                }
                row += `</div></td></tr>`;
                Fancybox.bind("#group" + i + " a", {});
                tbl.innerHTML += row
            }
        }

        $('.search_transport').bind("change keyup input click", function () {
            $.ajax({
                method: 'POST',
                url: "search/transport",
                data: {text_input: $(this).val(), _token: '{{csrf_token()}}'},
                success: function (data) {
                    $("#table tbody tr").remove();
                    buildTableTransport(data);
                }
            });
        });
    </script>
@endsection
