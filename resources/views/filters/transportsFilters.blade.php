<li class="nav-item">
    <a id="typeBody" class="button" onclick="showCarBodyTypeFilter()">Body style</a>
    <div id="typeBodyBlock" class="filterBlock" hidden>
        @if(!empty($carBodyTypes))
            @foreach($carBodyTypes as $type)
                <div class="form-check">
                    <input class="form-check-input type_checkbox" type="checkbox" id="{{$type->id}}"
                           attr-name="{{$type->id}}"
                           name="carBodyTypes">
                    <label class="form-check-label" for="{{$type->name}}">
                        {{$type->name}}
                    </label>
                </div>
            @endforeach
        @endif
    </div>
</li>

<li class="nav-item">
    <a id="owner" class="button" onclick="showOwnerFilter()">Owners</a>
    <div id="ownerBlock" class="filterBlock" hidden>
        @if(!empty($owners))
            @foreach($owners as $owner)
                <div class="form-check">
                    <input class="form-check-input owner_checkbox" type="checkbox" id="{{$owner->id}}"
                           attr-name="{{$owner->id}}"
                           name="owners">
                    <label class="form-check-label" for="{{$owner->name}}">
                        {{$owner->name}}
                    </label>
                </div>
            @endforeach
        @endif
    </div>
</li>

<li class="nav-item">
    <a id="country" class="button" onclick="showCountryFilter()">Countries</a>
    <div id="countryBlock" class="filterBlock" hidden>
        @if(!empty($countries))
            @foreach($countries as $country)
                <div class="form-check">
                    <input class="form-check-input country_checkbox" type="checkbox" id="{{$country->id}}"
                           attr-name="{{$country->id}}"
                           name="countries">
                    <label class="form-check-label" for="{{$country->name}}">
                        {{$country->name}}
                    </label>
                </div>
            @endforeach
        @endif
    </div>
</li>

<li class="nav-item">
    <a id="mileage" class="button">Mileage</a>
    <div id="mileageBlock" class="filterBlock row">
        <div class="col my-2 ms-2">
            <input type="number" id="minMileage" name="minMileage" class="form-control" placeholder="min" min="0">
        </div>
        <div class="col my-2 me-2">
            <input type="number" id="maxMileage" name="maxMileage" class="form-control" placeholder="max" min="0">
        </div>
    </div>
</li>

<button type="submit" class="btn btn-success m-2" onclick="filter(types,owners,countries)">OK</button>
<a class="btn btn-outline-danger mx-2" href="{{route('transport.index')}}">Reset</a>

