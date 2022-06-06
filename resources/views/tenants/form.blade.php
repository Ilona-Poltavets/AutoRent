<div class="card p-2 mb-2 form-card-background">

    <div class="form-group row my-2">
        <label for="name" class="col-2 col-form-label">Name</label>
        <div class="col-10">
            <input id="name" name="name" class="form-control" type="text"
                   value="{{isset($tenant)?$tenant->name:''}}"/>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="legal_entity" class="col-2 col-form-label">Legal entity</label>
        <div class="col-10">
            <select id="legal_entity" name="legal_entity" class="form-select">
                <option>Select type</option>
                <option value="1" {{isset($tenant)?(($tenant->legal_entity==1) ? 'selected':''):''}}>Entity</option>
                <option value="0" {{isset($tenant)?(($tenant->legal_entity==0) ? 'selected':''):''}}>Individual</option>
            </select>
        </div>
    </div>

    {{--
    <div class="form-group row my-2">
        <label for="user" class="col-2 col-form-label">User</label>
        <div class="col-10 autocomplete">
            <input name="user" list="users" class="form-control">
            <datalist id="users">
                <select>
                    @foreach($users as $user)
                    <option value="{{$user->name}}"></option>
    @endforeach
        </select>
    </datalist>
</div>
</div>--}}

    <div class="row my-2">
        <div class="offset-10 col-1">
            <a class="btn btn-danger float-right" href="{{ URL::previous() }}">Cancel</a>
        </div>

        <div class="col-1">
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </div>
    </div>
</div>
