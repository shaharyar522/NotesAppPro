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
///agar mara recorc update ungay to thek waran insert karo ga
if (isset($_POST['snoEdit'])) {
    $sno_id = $_POST["snoEdit"];
    $update_title = $_POST["titleEdit"];
    $update_description = $_POST["descriptionEdit"];

    $Update_query = "UPDATE `notes` SET `title` = '$update_title', `description` = '$update_description' WHERE `sno` = $sno_id";

    $result = mysqli_query($conn, $Update_query);

    if ($result) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your data has been updated successfully!',
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











