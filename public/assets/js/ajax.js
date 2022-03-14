$(document).ready()
{
    function filter(types, owners, countries) {
        types=JSON.stringify(types);
        owners=JSON.stringify(owners);
        countries=JSON.stringify(countries);
        $.ajax({
            method: 'GET',
            url: "filter/transport",
            data: {
                types,
                owners,
                countries,
            },
            success: function (result) {
                $("#table tbody tr").remove();
                console.log(result);
                buildTable(result.data);
            }
        });
    }
}
