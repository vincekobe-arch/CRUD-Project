<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vendor/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css">
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>

    <title>CRUD Project</title>
</head>
<body>
    <?php
        include './insert-modal.php';    
        include './edit-modal.php';
    ?>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Insert
</button>


    <table id="table-information" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Image</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                $connection = mysqli_connect("localhost", "root", "", "information_db");
                $query = "SELECT * FROM userinfo";
                $result = mysqli_query($connection, $query);
                
                if (mysqli_num_rows($result) >0 )
                    {
                        foreach($result as $data)
                        {
                            ?>
                                <tr>
                                    <td><?php echo $data['id']?></td>
                                    <td><?php echo $data['name']?></td>
                                    <td><?php echo $data['email']?></td>
                                    <td><?php echo $data['phone']?></td>
                                    <td><?php echo $data['address']?></td>
                                    <td>
                                        <?php if (!empty($data['image'])): ?>

                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($data['image']); ?>" 

                                                alt="User Image" width="80" height="80">

                                        <?php else: ?>

                                            No Image

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button id="btnDelete" class="btn btn-light"value="<?php echo $data['id'] ?>">
                                        <i class="fa-solid fa-bomb"></i>

                                        </button>
                                        <button id="btnEdit" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModalUpdate" value="<?php echo $data['id'] ?>">
                                        <i class="fa-solid fa-pencil"></i>

                                        </button>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
            ?>
            
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" ></script>
    <script src="script.js"></script>
</body>
</html>