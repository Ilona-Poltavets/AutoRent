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

    function filterRent(owners){
        owners=JSON.stringify(owners);
        let minDate=document.getElementById('dateStart').value;
        let maxDate=document.getElementById('dateEnd').value;
        let minPeriod=document.getElementById('rentalPeriodMin').value;
        let maxPeriod=document.getElementById('rentalPeriodMax').value;
        $.ajax({
            method:"GET",
            url:"filter/rent",
            data:{
                owners,
                minDate,
                maxDate,
                minPeriod,
                maxPeriod
            },
            success:function (result){
                $("#table tbody tr").remove();
                buildRentsTable(result.data);
            }
        })
    }
}
