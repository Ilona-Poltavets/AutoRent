<li class="nav-item">
    <a class="button">Continent</a>
    <div id="continent" class="filterBlock">
        <div class="form-check">
            <input class="form-check-input continent_checkbox" type="checkbox" id="North America" name="continents">
            <label class="form-check-label" for="North America">North America</label>
        </div>
        <div class="form-check">
            <input class="form-check-input continent_checkbox" type="checkbox" id="South America" name="continents">
            <label class="form-check-label" for="South America">South America</label>
        </div>
        <div class="form-check">
            <input class="form-check-input continent_checkbox" type="checkbox" id="Europe" name="continents">
            <label class="form-check-label" for="Europe">Europe</label>
        </div>
        <div class="form-check">
            <input class="form-check-input continent_checkbox" type="checkbox" id="Asia" name="continents">
            <label class="form-check-label" for="Asia">Asia</label>
        </div>
        <div class="form-check">
            <input class="form-check-input continent_checkbox" type="checkbox" id="Australia" name="continents">
            <label class="form-check-label" for="Australia">Australia</label>
        </div>
        <div class="form-check">
            <input class="form-check-input continent_checkbox" type="checkbox" id="Africa" name="continents">
            <label class="form-check-label" for="Africa">Africa</label>
        </div>
    </div>
</li>

<button type="submit" class="btn btn-success m-2" onclick="filterCountry(continents)">OK</button>
<a class="btn btn-outline-danger mx-2" href="{{route('country.index')}}">Reset</a>
