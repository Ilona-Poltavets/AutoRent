<li class="nav-item">
    <a id="legalEntity" class="button">Entities</a>
    <div id="legalEntityBlock" class="filterBlock">
        {{--<div class="form-check">
            <input class="form-check-input legalEntity_checkbox" type="checkbox" id="0" name="legal_entity">
            <label class="form-check-label" for="0">
                Individual
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input legalEntity_checkbox" type="checkbox" id="1" name="legal_entity">
            <label class="form-check-label" for="1">
                Legal entity
            </label>
        </div>
        --}}
        <select id="legal_entity" name="legal_entity" class="form-select legalEntity_select">
            <option value="">All</option>
            <option value="0">Individual</option>
            <option value="1">Legal entity</option>
        </select>
    </div>
</li>

<script>
    $("select.legalEntity_select").change(function(){
        $.ajax({
            method: "GET",
            url: "filter/owner",
            data: {legal_entity: $(this).val()},
            success: function (result) {
                $("#table tbody tr").remove();
                buildTableOwner(result.data);
            }
        })
    });
</script>
