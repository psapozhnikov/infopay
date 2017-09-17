$(document).on('click','#btnSearch',function () {
    const phoneNumber = $('#phone_number').val();
    if (phoneNumber === ''){
        alert('Phone Number is required.');
        return false;
    }
    $.ajax({
        url: 'phone_search_controller.php',
        dataType: 'json',
        data: {phone_number: phoneNumber},
        method: 'POST'
    }).done(function (data) {
        $.get('index.mustache', function (template) {
            let rendered = Mustache.render(template, data);
            $('#target').html(rendered);
        });
    }).fail(function () {
        alert('An error has occurred');
    });
});

$(document).on('click', '.expand', function (e) {
    const recordId = e.target.dataset.recordId;
    let recordDetails = $('.record-details-' + recordId);
    let expandNode = $('.expand-' + recordId);
    if (recordDetails.hasClass('hidden')) {
        recordDetails.removeClass('hidden');
        expandNode.text('-');
    } else {
        recordDetails.addClass('hidden');
        expandNode.text('+');
    }

});

$(document).on('click', '.person_detail', function (e) {
    const firstName = e.target.dataset.firstName;
    const lastName = e.target.dataset.lastName;
    const phoneNumber = e.target.dataset.phoneNumber;

    $.ajax({
        url: 'phone_search_controller.php',
        dataType: 'json',
        data: {phone_number: phoneNumber, first_name: firstName, last_name:lastName},
        method: 'POST'
    }).done(function (data) {
        $.get('index.mustache', function (template) {
            let rendered = Mustache.render(template, data);
            $('#target').html(rendered);
        });
    }).fail(function () {
        alert('An error has occurred');
    });
});

function loadApp() {
    $.get('index.mustache', function (template) {
       let rendered = Mustache.render(template, {'is_load': true});
       $('#target').html(rendered);
    });
}