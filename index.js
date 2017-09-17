$(document).on('click','#btnSearch',function () {
    let phoneNumber = $('#phone_number').val();
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
    });
});

$(document).on('click', '.expand', function (e) {
    let recordId = e.target.dataset.recordId;
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

function loadApp() {
    $.get('index.mustache', function (template) {
       let rendered = Mustache.render(template, {'is_load': true});
       $('#target').html(rendered);
    });
}