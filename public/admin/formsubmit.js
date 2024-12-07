function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".print-success-msg").css('display', 'none');
    $.each(msg, function (key, value) {
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
    });
}
$('form').on('submit', function (event) {
    event.preventDefault();
    $('.validation-errors').remove();
    data = new FormData(this);
    var redirecturl = $(this).attr('redirect');
    var submitBtn = $(this).find("button:submit");
    console.log(submitBtn);
    // addLoader(submitBtn);
    var errorCustomCount = $('.error-custom').not(':hidden').length;
    console.log(errorCustomCount);
    if (errorCustomCount === 0){

   
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
            if($('#matching_footer').length){
                location.reload(true);
            }
            if (redirecturl) {
                appendSuccess(response.message);
                window.location.replace(redirecturl);
            } else {
                appendSuccess(response.message);
                if ($('#commonModal').is(':visible')) {
                    $("#commonModal").toggle('fast');
                }
                if (table) {
                    table.ajax.reload();
                }
            }
            $("#modal").hide();
        },
        error: function (response) {
            console.log(response);
            // if (submitBtn) {
                // removeLoader(submitBtn);
            // }
            if (response.status === 422) {

                if (
                    Object.keys(response.responseJSON).length > 0 &&
                    Object.keys(response.responseJSON.errors).length > 0
                ) {
                    show_validation_error(response.responseJSON.errors);

                    printErrorMsg(response.responseJSON.errors);
                }
            } else {
                     console.log(response.responseJSON.message);
                appendError(response.responseJSON.message);
            }
        }
    });
}
});

function show_validation_error(msg) {
    if ($.isPlainObject(msg)) {
        $data = msg;
    } else {
        $data = $.parseJSON(msg);
    }

    $.each($data, function (index, value) {
        if ($('form [name="' + index + '[]"]').length > 0) {
            if ($('form [name="' + index + '[]"]').hasClass('select2')) {
                $('form [name="' + index + '[]"]').next().after('<span class="text-danger text-md validation-errors">' + value + '</span>');
            } else {
                $('form [name="' + index + '[]"]').after('<span class="text-danger text-md validation-errors">' + value + '</span>');
            }
        } else {
            $('form [name="' + index + '"]').after('<span class="text-danger text-md validation-errors">' + value + '</span>');
        }
    });
}
