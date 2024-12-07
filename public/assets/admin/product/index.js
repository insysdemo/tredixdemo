var table = $("#product").DataTable({
    "fixedHeader": {
        header: true,
        footer: true
    },
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url + "/admin/products/list", // Include 'admin' prefix
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


function createProduct(e) {
    addLoader(e);
    $.ajax({
        url: base_url + "/admin/products/create",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Add Products");
            $("#commonModalContent").html($response.data);
            removeLoader(e);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);

        }
    });
}


function editProduct(e, id) {
    addLoader(e);
    $.ajax({
        url: base_url + "/admin/products/" + id + "/edit",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Edit Products");
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