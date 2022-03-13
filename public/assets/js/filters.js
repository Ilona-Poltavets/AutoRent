$(document).ready()
{
    function showCarBodyTypeFilter() {
        var block = document.getElementById('typeBodyBlock');
        block.hidden = !block.hidden;
    }

    var types = [];
    $(document).on('click', '.category_checkbox', function () {
        if (types.indexOf($(this).attr('id')) === -1) {
            types.push($(this).attr('id'));
        } else {
            types.splice(types.indexOf($(this).attr('id')), 1);
        }
        console.log(types);
    })
}
