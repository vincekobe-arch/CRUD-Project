$(document).on('click', '#btnDelete', function(e){
    e.preventDefault();
    var data_id = $(this).val();
    console.log(data_id);

    if(confirm("Are you sure to delete this item?"))
    {
        $.ajax({
            type: "POST",
            url: "action.php",
            data: {
                'delete_data': true,
                'data_id': data_id
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500)
                {
                    alert(res.message);
                }
                else
                {
                    Swal.fire({
                    icon: "error",
                    title: "Deleted Successfully",
                    

                    });
                    $('#table-information').load(location.href + " #table-information") 
                }
            }
        })
    }
});

$(document).on('submit', '#insert_data', function(e){
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_data", true);

    $.ajax({ 
        type: "POST",
        url: "action.php",
        data: formData,
        processData:false,
        contentType:false,

        success: function (response){
            var res = JSON.parse(response)
            if(res.status == 500){
                alert(res.message);
            }else{
                
                Swal.fire({
                title: "Sucessfully Saved!",
                text: res.me,
                icon: "success"
                });
                $("#exampleModal").modal('hide');
                              $("#insert_data")[0].reset();
                $('#table-information').load(location.href + " #table-information")
            }
        }
    });  
});