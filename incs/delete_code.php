<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include("connection.php");
    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $delete_query = "DELETE FROM notes where sno = $sno";
        $result = mysqli_query($conn, $delete_query);
        if ($result) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your data has been Deleted Successfully !',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Update query failed!',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                  </script>";
        }
    }














    ?>




</body>

</html>