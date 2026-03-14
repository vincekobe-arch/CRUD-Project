$(document).ready(function () {
    $("#table-information").DataTable();
});

$(document).on("click", "#btnEdit", function (e) {
    e.preventDefault();

    var data_id = $(this).val();

    $.ajax({
        type: "POST",

        url: "action.php",

        data: {
            fetch_single_data: true,

            data_id: data_id,
        },

        success: function (response) {
            var res = jQuery.parseJSON(response);

            if (res.status == 200) {
                $("#id").val(res.data.id);

                $("#fullname").val(res.data.name);

                $("#email").val(res.data.email);

                $("#phone").val(res.data.phone);

                $("#address").val(res.data.address);
            } else {
                alert(res.message);
            }
        },
    });
});

$(document).on("click", "#btnDelete", function (e) {
    e.preventDefault();

    var data_id = $(this).val();

    console.log(data_id);

    if (confirm("Are you sure to delete this item?")) {
        $.ajax({
            type: "POST",

            url: "action.php",

            data: {
                delete_data: true,

                data_id: data_id,
            },

            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 500) {
                    alert(res.message);
                } else {
                    Swal.fire({
                        title: "Deleted",

                        text: res.message,

                        icon: "success",
                    });

                    $("#table-information").load(location.href + " #table-information");
                }
            },
        });
    }
});

$(document).on("submit", "#insert_data", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    formData.append("save_data", true);

    $.ajax({
        type: "POST",

        url: "action.php",

        data: formData,

        processData: false,

        contentType: false,

        success: function (response) {
            var res = JSON.parse(response);

            if (res.status == 500) {
                alert(res.message);
            } else {
                Swal.fire({
                    title: "Inserted",

                    text: res.message,

                    icon: "success",
                });

                $("#exampleModal").modal("hide");

                $("#insert_data")[0].reset();

                $("#table-information").load(location.href + " #table-information");
            }
        },
    });
});

$(document).on("submit", "#edit_data", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    formData.append("edit_data", true);

    $.ajax({
        type: "POST",

        url: "action.php",

        data: formData,

        processData: false,

        contentType: false,

        success: function (response) {
            var res = JSON.parse(response);

            if (res.status == 500) {
                alert(res.message);
            } else {
                Swal.fire({
                    title: "Updated",

                    text: res.message,

                    icon: "success",
                });

                $("#exampleModalUpdate").modal("hide");

                $("#edit_data")[0].reset();

                $("#table-information").load(location.href + " #table-information");
            }
        },
    });
});
