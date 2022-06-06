<li class="nav-item">
    <a id="owner" class="button">Owners</a>
    <input class="find_owner form-control" type="text" placeholder="find owner">
    <div id="myBlock" class="filterBlock style-4" style="overflow-y: scroll;max-height: 300px">
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
    <a id="owner" class="button">Date</a>
    <div id="dateBlock" class="filterBlock row">
        <div class="col my-2 ms-2">
            <input id="dateStart" name="dateStart" type="text" class="form-control filterTime"
                   placeholder="From">
        </div>
        <div class="col my-2 me-2">
            <input id="dateEnd" name="dateEnd" type="text" class="form-control filterTime"
                   placeholder="To">
        </div>
    </div>
</li>

<li class="nav-item">
    <a id="owner" class="button">Rental period</a>
    <div id="periodBlock" class="filterBlock row">
        <div class="col my-2 ms-2">
            <input id="rentalPeriodMin" name="rentalPeriodMin" type="number" class="form-control" placeholder="0"
                   min="0">
        </div>
        <div class="col my-2 me-2">
            <input id="rentalPeriodMax" name="rentalPeriodMax" type="number" class="form-control" placeholder="0"
                   min="0">
        </div>
    </div>
</li>

<button type="submit" class="btn btn-success m-2" onclick="filterRent(owners)">OK</button>
<a class="btn btn-outline-danger mx-2" href="{{route('rent.index')}}">Reset</a>

<script>
    $('.find_owner').bind("change keyup input click", function () {
        $.ajax({
            method: 'POST',
            url: "search/owner",
            data: {text_input: $(this).val(), _token: '{{csrf_token()}}'},
            success: function (data) {
                const block = document.getElementById('myBlock');
                $('#myBlock div').remove();
                for (let i = 0; i < data.length; i++) {
                    var row = `
                    <div class="form-check">
                    <input class="form-check-input owner_checkbox" type="checkbox" id="${data[i].id}"
                           attr-name="${data[i].id}"
                           name="owners">
                    <label class="form-check-label" for="${data[i].name}">
                        ${data[i].name}
                    </label>
                </div>`;
                    block.innerHTML += row;
                }
            }
        })
    })
</script>
