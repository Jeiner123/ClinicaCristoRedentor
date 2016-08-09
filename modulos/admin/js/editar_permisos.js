$(document).on('ready', function () {
    $('input[type=checkbox]').on('change', checkboxOnChange);
});

function checkboxOnChange() {
    var user = $('#user').val();
    var newValue = $(this).is(':checked'); // true or false
    var itemId = $(this).val();
    var data = {
        username: user,
        value: newValue,
        item_id: itemId
    };
    $.post('./json/post_permisos.php', data, function (data) {
        console.log(data);
    }, 'json');
}
