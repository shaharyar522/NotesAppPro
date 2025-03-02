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

    if (isset($_POST['snoEdit']) && !empty($_POST['snoEdit'])) {
        $sno_id = $_POST["snoEdit"];
        $update_title = $_POST["titleEdit"];
        $update_description = $_POST["descriptionEdit"];

        // Check if currentImage exists
        $imagePath = isset($_POST['currentImage']) ? $_POST['currentImage'] : '';

        // Handle new image upload if provided
        if (!empty($_FILES['imageEdit']['name'])) {
            $imageName = time() . "_" . $_FILES['imageEdit']['name'];
            $imagePath = "uploads/" . $imageName;
            move_uploaded_file($_FILES['imageEdit']['tmp_name'], $imagePath);
        }

        // Ensure all fields are properly escaped to prevent SQL injection
        $update_title = mysqli_real_escape_string($conn, $update_title);
        $update_description = mysqli_real_escape_string($conn, $update_description);
        $imagePath = mysqli_real_escape_string($conn, $imagePath);

        // Update Query
        $update_query = "UPDATE `notes` SET `title` = '$update_title', `description` = '$update_description', `image_path` = '$imagePath' WHERE `sno` = '$sno_id'";

        $result = mysqli_query($conn, $update_query);
        if ($result) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: 'Your note has been updated successfully!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'index.php'; // Redirect after success
            });
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Update failed!',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        </script>";
        }
    } 

    ?>


</body>

</html>