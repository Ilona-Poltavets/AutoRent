$(document).ready()
{
    function showCarBodyTypeFilter() {
        var block = document.getElementById('typeBodyBlock');
        block.hidden = !block.hidden;
    }

    function showOwnerFilter() {
        var block = document.getElementById('ownerBlock');
        block.hidden = !block.hidden;
    }

    function showCountryFilter() {
        var block = document.getElementById('countryBlock');
        block.hidden = !block.hidden;
    }

    var types = [];
    var owners = [];
    var countries = [];

    $(document).on('click', '.type_checkbox', function () {
        if (types.indexOf($(this).attr('id')) === -1) {
            types.push($(this).attr('id'));
        } else {
            types.splice(types.indexOf($(this).attr('id')), 1);
        }
    })
    $(document).on('click', '.owner_checkbox', function () {
        console.log(owners);
        if (owners.indexOf($(this).attr('id')) === -1) {
            owners.push($(this).attr('id'));
        } else {
            owners.splice(owners.indexOf($(this).attr('id')), 1);
        }
    })
    $(document).on('click', '.country_checkbox', function () {
        if (countries.indexOf($(this).attr('id')) === -1) {
            countries.push($(this).attr('id'));
        } else {
            countries.splice(countries.indexOf($(this).attr('id')), 1);
        }
    })
}
