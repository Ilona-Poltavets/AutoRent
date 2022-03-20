<div class="card p-2 mb-2 form-card-background">

    <div class="form-group row my-2">
        <label for="photos[]" class="col-2 col-form-label">Photo</label>
        <div class="col-10">
            <input multiple="multiple" name="photos[]" class="form-control" type="file"/>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="model" class="col-2 col-form-label">Model</label>
        <div class="col-10">
            <input id="model" name="model" class="form-control" type="text"
                   value="{{isset($transport)?$transport->model:''}}"/>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="number" class="col-2 col-form-label">Number</label>
        <div class="col-10">
            <input id="number" name="number" class="form-control" type="text"
                   value="{{isset($transport)?$transport->number:''}}"/>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="mileage" class="col-2 col-form-label">Mileage</label>
        <div class="col-10">
            <input id="mileage" name="mileage" class="form-control" type="number"
                   value="{{isset($transport)?$transport->mileage:''}}"/>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="mileage" class="col-2 col-form-label">Manufacturer country</label>
        <div class="col-10">
            <select class="form-select" name="country_id">
                <option
                    {{isset($transport)? '':'selected'}} disabled>Country
                </option>
                @foreach($countries as $country)
                    <option
                        {{isset($transport)? ($transport->country_id==$country->id ? 'selected':''):''}} value="{{$country->id}}">{{$country->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="body_type" class="col-2 col-form-label">Body type</label>
        <div class="col-10">
            <select class="form-select" name="body_type_id">
                <option
                    {{isset($transport)? '':'selected'}} disabled>Body type
                </option>
                @foreach($carBodyTypes as $bodyType)
                    <option
                        {{isset($transport)? ($transport->body_type_id==$bodyType->id ? 'selected':''):''}} value="{{$bodyType->id}}">{{$bodyType->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="owner" class="col-2 col-form-label">Owner</label>
        <div class="col-10">
            <select class="form-select" name="owner_id">
                <option
                    {{isset($transport)? '':'selected'}} disabled>Owner
                </option>
                @foreach($owners as $owner)
                    <option
                        {{isset($transport)? ($transport->owner_id==$owner->id ? 'selected':''):''}} value="{{$owner->id}}">{{$owner->name}}
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
