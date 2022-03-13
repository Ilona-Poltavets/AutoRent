$(document).ready()
{
    $('.search_transport').bind("change keyup input click", function () {
        if ($(this).val().length > 0) {
            $.ajax({
                method: 'POST',
                url: "{{url('search/transport')}}",
                data: {text_input: $(this).val(), _token: '{{csrf_token()}}'},
                success: function (data) {
                    $("#table tbody tr").remove();
                    buildTable(data);
                }
            });
        }
    });

    function filter(types) {
        console.log(types)
        $.ajax({
            method: 'GET',
            url: "transport/filter/" + types,
            success: function (data) {
                $("#table tbody tr").remove();
                buildTable(data);
            }
        });
    }
}
