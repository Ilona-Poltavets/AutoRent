<div class="card p-2 mb-2 form-card-background">

    <div class="form-group row my-2">
        <label for="date" class="col-2 col-form-label">Start date</label>
        <div class="col-10">
            <input id="date" name="date" class="date form-control" type="text" value="{{isset($rent)?$rent->data:''}}">
        </div>
    </div>

    <script type="text/javascript">
        $('.date').datepicker({
            format: 'mm-dd-yyyy'
        });
    </script>

    <div class="form-group row my-2">
        <label for="rental_period" class="col-2 col-form-label">Rental period</label>
        <div class="col-10">
            <input id="rental_period" name="rental_period" class="form-control" type="number"
                   value="{{isset($rent)?$rent->rental_period:''}}"/>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="id_owner" class="col-2 col-form-label">Owner</label>
        <div class="col-10">
            <select class="form-control" name="id_owner" disabled>
                {{--
                <option
                    {{isset($rent)? '':'selected'}} disabled>Owner
                </option>
                --}}
                @foreach($owners as $owner)
                    <option
                        {{isset($rent)? ($rent->id_owner==$owner->id ? 'selected':''):''}} value="{{$owner->id}}">{{$owner->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="id_transport" class="col-2 col-form-label">Transport</label>
        <div class="col-10">
            <select class="form-control" name="id_transport" disabled>
                {{--
                <option
                    {{isset($rent)? '':'selected'}} disabled>Transport
                </option>
                --}}
                @foreach($transports as $transport)
                    <option
                        @if(isset($rent))
                        {{$rent->id_transport==$transport->id ? 'selected disabled':''}}
                        @elseif($transportId)
                        {{$transportId==$transport->id?'selected disabled':''}}
                        @else
                        {{''}}
                        @endif
                        value="{{$transport->id}}">{{$transport->model}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="id_tenant" class="col-2 col-form-label">Tenant</label>
        <div class="col-10">
            <select class="form-select" name="id_tenant">
                <option
                    {{isset($rent)? '':'selected'}} disabled>Tenant
                </option>
                @foreach($tenants as $tenant)
                    <option
                        {{isset($rent)? ($rent->id_tenant==$tenant->id ? 'selected':''):''}} value="{{$tenant->id}}">{{$tenant->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row my-2">
        <div class="offset-10 col-1">
            <a class="btn btn-danger float-right" href="{{ URL::previous() }}">Cancel</a>
        </div>

        <div class="col-1">
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </div>
    </div>
</div>
