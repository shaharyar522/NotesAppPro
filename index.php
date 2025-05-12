<?php
require_once("./incs/connection.php");
$insert = false;
//AB HUM form main data insert karin guy
if (isset($_POST['submit']) && $_POST['submit'] == 'sub') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    //uay hamray pass image wala code hian 

    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $imagePath = "uploads/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }


    $query = " INSERT INTO `notes` (`title`, `description`, `image_path`, `tstamp`) VALUES ('$title', '$description', ' $imagePath', current_timestamp());";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $insert = true;
        header("Location: index.php");
        exit();
    }
}


//update code 
require_once("./incs/update_code.php");
//Delete code
require_once("./incs/delete_code.php");
?>
<!-- workin  -->
<!doctype html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <style>
        <?php include("css/main.css") ?>
    </style>
    <style>
        .navbar {
            background: linear-gradient(45deg, #28a745, #218838);
        }

        .navbar-brand,
        .nav-link {
            font-weight: bold;
        }

        .nav-link:hover {
            color: #ffd700 !important;
        }

        .translate {
            margin-right: 15px;
        }

        .btn-outline-success {
            border-color: white;
            color: white;
        }

        .btn-outline-success:hover {
            background-color: white;
            color: #28a745;
        }

        /* Google Translate Dropdown Styling */
        /* Google Translate Styling */
        #google_translate_element {
            background-color: white;
            text-align: center;
            background: #222;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: fit-content;
            display: inline-block;
        }

        /* Styling the select dropdown */
        .goog-te-combo {
            font-size: 16px;
            padding: 8px 12px;
            border: 2px solid white;
            background: #333;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        .goog-te-combo:hover {
            background:#2a5298;
            color: #222;
            border-color: #fff;
            color: white;
        }

        /* Remove Google branding */
        .goog-logo-link,
        .goog-te-gadget span,
        .goog-te-banner-frame {
            display: none !important;
        }

        /* Hide frame */
        .goog-te-gadget {
            font-size: 0 !important;
        }

        /* Add hover effect */
        #google_translate_element:hover {
            transform: translateY(-3px);
            transition: 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <!-- Start modal for when click the edit button then open  -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edits This Notes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./index.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <input type="hidden" name="currentImage" id="currentImage"> <!-- Add this line -->

                        <div class="mb-3">
                            <label for="titleEdit" class="form-label">Title</label>
                            <input type="text" name="titleEdit" id="titleEdit" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="descriptionEdit" class="form-label">Description</label>
                            <textarea name="descriptionEdit" id="descriptionEdit" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="imageEdit" class="form-label">Upload New Image (optional)</label>
                            <input type="file" name="imageEdit" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Note</button>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end the edit modal -->


    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Notes App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Contact</a>
                    </li>
                </ul>
                <div class="translate" id="google_translate_element"></div>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- navbar End -->

    <!-- starting js google translating code -->
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!-- Ending js google translating code  -->



    <!-- agar mara data khbi insert hnva to main ek Alert ko show karo ga -->
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your Record Has been successfully!.
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    }
    ?>


    <!-- hum ny ek container banya hian or es main ek form dalla hian -->
    <div class="container  my-4">
        <h1>Add a Notes</h1>
        <form action="./index.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" placeholder="Enter Your Title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" placeholder="Enter Your Description" class="form-control" rows="3" id="summernote"></textarea>
            </div>
            <!-- hum ny ek image wali file banay hain  -->
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <!-- or ek image end   file dali hian -->
            <button type="submit" class="btn btn-primary" name="submit" value="sub">Submit</button>
        </form>
    </div>

    <!-- ab hum ny ek or container bana hian jis main hamra data show hnga -->
    <!-- ed main jo id=myTable hain wo data table ki dalle hnve hain  -->
    <div class="container my-4">
        <!-- uay hamray pass table hian -->
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th> <!-- Added Image Column -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM notes";
                $result = mysqli_query($conn, $query);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
                     <th>" . $sno . "</th>
                      <td>" . $row['title'] . "</td>
                      <td>" . $row['description'] . "</td>";

                    // Display image if available, otherwise show "No Image"
                    echo "<td>";
                    if (!empty($row['image_path'])) {
                        echo "<img src='{$row['image_path']}' width='100' height='100'>";
                    } else {
                        echo "No Image";
                    }
                    echo "</td>";

                    echo "<td> 
                      <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> 
                      <button class='delete btn btn-sm btn-danger' id=d" . $row['sno'] . ">Delete</button>
                  </td>
                 </tr>";
                }
                ?>
            </tbody>
        </table>

        <hr>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- uay hamray pass css or js  hian data table ki -->
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>

    <!-- edit js -->
    <script src="js/edit.js"></script>
    <!-- Delete js -->
    <script src="js/delete.js"></script>



    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>







</body>

</html>