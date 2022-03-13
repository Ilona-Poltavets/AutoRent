<li class="nav-item">
    <a id="typeBody" class="button" onclick="showCarBodyTypeFilter()">Car body type</a>
    <div id="typeBodyBlock" class="filterBlock" hidden>
        @if(!empty($carBodyTypes))
            @foreach($carBodyTypes as $type)
                <div class="form-check">
                    <input class="form-check-input category_checkbox" type="checkbox" id="{{$type->id}}"
                           attr-name="{{$type->id}}"
                           name="carBodyTypes[]">
                    <label class="form-check-label" for="{{$type->name}}">
                        {{$type->name}}
                    </label>
                </div>
            @endforeach
        @endif
    </div>
</li>
<button type="submit" class="btn btn-success m-2" onclick="filter(types)">OK</button>

<script>
    /*function showCarBodyTypeFilter() {
        var block = document.getElementById('typeBodyBlock');
        block.hidden = !block.hidden;
    }

    var types = [];
    $(document).on('click', '.category_checkbox', function () {
        if (types.indexOf($(this).attr('id')) === -1) {
            types.push($(this).attr('id'));
        } else {
            types.splice(types.indexOf($(this).attr('id')), 1);
        }
        console.log(types);
    })

    function filter(types) {
        console.log(types)
        $.ajax({
            method: 'GET',
            url: "transport/filter/" + types,
            success: function (data) {
                $("#table tbody tr").remove();
                buildTable(data);
            }
        });
    }*/
</script>
