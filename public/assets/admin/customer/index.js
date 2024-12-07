var table = $("#customer").DataTable({
    "fixedHeader": {
        header: true,
        footer: true
    },
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url + "/admin/customer/list", // Include 'admin' prefix
        "dataType": "json",
        "type": "POST",
        data: function (data) {
            data._token = token;
        }
    },
    columnDefs: [{
        "targets": [0, 2],
        "orderable": false
    }],
    scrollX: true,
    scrollCollapse: true
});


function createCustomer(e) {
    addLoader(e);
    $.ajax({
        url: base_url + "/admin/customer/create",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Add Customer");
            $("#commonModalContent").html($response.data);
            removeLoader(e);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);

        }
    });
}


function editCustomer(e, id) {
    addLoader(e);
    $.ajax({
        url: base_url + "/admin/customer/" + id + "/edit",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Edit Customer");
            $("#commonModalContent").html($response.data);
            showDiv(e);
            removeLoader(e);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);
            removeLoader(e);
        }
    });
}
