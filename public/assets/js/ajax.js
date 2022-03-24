$(document).ready()
{
    function filter(types, owners, countries) {
        types = JSON.stringify(types);
        owners = JSON.stringify(owners);
        countries = JSON.stringify(countries);
        let min = document.getElementById('minMileage').value;
        let max = document.getElementById('maxMileage').value;
        console.log(min);
        $.ajax({
            method: 'GET',
            url: "filter/transport",
            data: {
                types,
                owners,
                countries,
                min,
                max
            },
            success: function (result) {
                $("#table tbody tr").remove();
                buildTableTransport(result.data);
            }
        });
    }

    function filterCountry(continents) {
        continents = JSON.stringify(continents);
        console.log(continents);
        $.ajax({
            method: 'GET',
            url: "filter/country",
            data: {
                continents
            },
            success: function (result) {
                $("#table tbody tr").remove();
                buildCountryTable(result.data);
            }
        })
    }
}
