$(document).on('click','#btnSearch',function () {
    $.ajax({
        url: 'phone_search_controller.php',
        dataType: 'json',
        data: {phone_number: $('#phone_number').val()},
        method: 'POST'
    }).done(function (data) {
        alert('done');
    }).fail(function () {
       alert('fail');
    });
});

function loadApp() {
    $.get('index.mustache', function (template) {
       let rendered = Mustache.render(template);
       $('#target').html(rendered);
    });
}