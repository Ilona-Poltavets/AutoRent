<div class="card p-2 mb-2 form-card-background">

    <div class="form-group row my-2">
        <label for="name" class="col-2 col-form-label">Name</label>
        <div class="col-10">
            <input id="name" name="name" class="form-control" type="text" value="{{isset($owner)?$owner->name:''}}"/>
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
