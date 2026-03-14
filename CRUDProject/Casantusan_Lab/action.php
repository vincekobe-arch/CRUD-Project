<?php

    $con = mysqli_connect("localhost", "root", "", "information_db");



    if(!$con)

    {

        die('connection Failed'.mysqli_connect_error());

    }



if(isset($_POST['delete_data']))

{

    $id = mysqli_real_escape_string($con, $_POST['data_id']);



    $query = "DELETE FROM userinfo WHERE id='$id'";

    $query_run = mysqli_query($con, $query);   



    if($query_run)

    {

        $res = [

            'status' => 200,

            'message' => 'Deleted Successfully'

        ];

        echo json_encode($res);

        return;

    }else{

        $res = [

            'status' => 500,

            'message' => 'Not Deleted'

        ];

        echo json_encode($res);

        return;

    }

}



if (isset($_POST['save_data'])) {
    $email   = mysqli_real_escape_string($con, $_POST['email']);
    $name    = mysqli_real_escape_string($con, $_POST['fullname']);
    $phone   = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        $allowed  = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($fileType, $allowed)) {
            echo json_encode(['status' => 400, 'message' => 'Invalid image type']);
            return;
        }

        $imageData = file_get_contents($_FILES['image']['tmp_name']);

        // Updated bind_param to use 'b' for blob
        $stmt = $con->prepare("INSERT INTO userinfo (email, name, phone, address, image) VALUES (?, ?, ?, ?, ?)");
        $null = NULL; 
        $stmt->bind_param("ssssb", $email, $name, $phone, $address, $null);
        $stmt->send_long_data(4, $imageData);

        if ($stmt->execute()) {
            echo json_encode(['status' => 200, 'message' => 'Data Saved Successfully']);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Error saving data: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 400, 'message' => 'Please select an image']);
    }
}



if (isset($_POST['edit_data'])) {

    $id      = $_POST['id'];

    $email   = $_POST['email'];

    $name    = $_POST['fullname'];

    $phone   = $_POST['phone'];

    $address = $_POST['address'];



    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $fileType = mime_content_type($_FILES['image']['tmp_name']);

        $allowed  = ['image/jpeg', 'image/png', 'image/gif'];



        if (!in_array($fileType, $allowed)) {

            echo json_encode(['status' => 400, 'message' => 'Invalid image type']);

            return;

        }



        $imageData = file_get_contents($_FILES['image']['tmp_name']);



        $stmt = $con->prepare("UPDATE userinfo SET email=?, name=?, phone=?, address=?, image=? WHERE id=?");

        $null = NULL;

        $stmt->bind_param("ssssbi", $email, $name, $phone, $address, $null, $id);

        $stmt->send_long_data(4, $imageData);

    } else {

        // Update without changing image

        $stmt = $con->prepare("UPDATE userinfo SET email=?, name=?, phone=?, address=? WHERE id=?");

        $stmt->bind_param("ssssi", $email, $name, $phone, $address, $id);

    }



    if ($stmt->execute()) {

        echo json_encode(['status' => 200, 'message' => 'Updated Successfully']);

    } else {

        echo json_encode(['status' => 500, 'message' => 'Update Failed']);

    }

    $stmt->close();

}




if(isset($_POST['fetch_single_data']))

{

    $id = mysqli_real_escape_string($con, $_POST['data_id']);

    

    $query = "SELECT * FROM userinfo WHERE id='$id'";

    $query_run = mysqli_query($con, $query);

    

    if(mysqli_num_rows($query_run) > 0)

    {

        $row = mysqli_fetch_assoc($query_run);

        $res = [

            'status' => 200,

            'data' => $row

        ];

        echo json_encode($res);

        return;

    }else{

        $res = [

            'status' => 500,

            'message' => 'Data not found'

        ];

        echo json_encode($res);

        return;

    }

}





?>
