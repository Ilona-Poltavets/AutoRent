<div class="card p-2 mb-2 form-card-background">

    <div class="form-group row my-2">
        <label for="name" class="col-2 col-form-label">Name</label>
        <div class="col-10">
            <input id="name" name="name" class="form-control" type="text"
                   value="{{isset($country)?$country->name:''}}"/>
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="name" class="col-2 col-form-label">Name</label>
        <div class="col-10">
            <select name="continent" class="form-select">
                <option value="continent"
                        disabled {{isset($country)?($country->continent==null?'selected':''):'selected'}}>Continent
                </option>
                <option
                    value="North America"{{isset($country)?($country->continent=="North America"?'selected':''):'selected'}}>
                    North America
                </option>
                <option
                    value="South America"{{isset($country)?($country->continent=="South America"?'selected':''):'selected'}}>
                    South America
                </option>
                <option value="Europe"{{isset($country)?($country->continent=="Europe"?'selected':''):'selected'}}>
                    Europe
                </option>
                <option value="Asia"{{isset($country)?($country->continent=="Asia"?'selected':''):'selected'}}>Asia
                </option>
                <option
                    value="Australia"{{isset($country)?($country->continent=="Australia"?'selected':''):'selected'}}>
                    Australia
                </option>
                <option value="Africa"{{isset($country)?($country->continent=="Africa"?'selected':''):'selected'}}>
                    Africa
                </option>
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
