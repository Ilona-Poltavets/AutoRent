<div class="card p-2 mb-2 form-card-background">

    <dic class="form-group row my-2">
        <label for="logo" class="col-2 col-form-label">Logo</label>
        <div class="col-10">
            <input name="logo" type="file" class="form-control">
        </div>
    </dic>

    <div class="form-group row my-2">
        <label for="name" class="col-2 col-form-label">Name</label>
        <div class="col-10">
            <input id="name" name="name" class="form-control" type="text" value="{{isset($owner)?$owner->name:''}}"/>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="legal_entity" class="col-2 col-form-label">Legal entity</label>
        <div class="col-10">
            <select id="legal_entity" name="legal_entity" class="form-select legalEntity_select">
                <option value="" selected disabled>Choose legal entity...</option>
                <option value="0" {{isset($owner)?(($owner->legal_entity==0)?'selected':''):''}}>Individual</option>
                <option value="1" {{isset($owner)?(($owner->legal_entity==1)?'selected':''):''}}>Legal entity</option>
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
