<?php
require_once("./incs/connection.php");
$insert = false;
//AB HUM form main data insert karin guy
if (isset($_POST['submit']) && $_POST['submit'] == 'sub') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "INSERT INTO `notes` (`title`, `description`, `tstamp`) VALUES ('$title', '$description', current_timestamp());";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $insert = true;
    }
}
//update code 
require_once("./incs/update_code.php");

//Delete code
require_once("./incs/delete_code.php");

?>
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
     <!-- Summernote CSS - CDN Link -->
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->
   
 

 <style>
      /* General Styles */
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: #fff;
    min-height: 100vh;
 }
/* Navbar */
 .navbar {
    background: rgba(0, 0, 0, 0.6) !important;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
    padding: 15px 20px;
 }

 .navbar-brand {
    font-size: 2rem;
    font-weight: bold;
    color: #f8f9fa !important;
    transition: 0.3s;
 }

 .navbar-brand:hover {
    color: #4ca1af !important;
 }

 .navbar-nav .nav-link {
    color: #f8f9fa !important;
    font-size: 1.2rem;
    padding: 10px;
    transition: 0.3s;
 }

  .navbar-nav .nav-link:hover {
    color: #4ca1af !important;
    transform: scale(1.1);
 }

/* Container */
  .container {
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    margin-top: 30px;
  }

  h1 {
    text-align: center;
    color: #f8f9fa;
 }

/* Forms */
  .form-control {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: #fff;
 }

 .form-control:focus {
    background: rgba(255, 255, 255, 0.3);
    color: #fff;
    box-shadow: none;
    border-left: 3px solid #4ca1af;
 }

  textarea.form-control {
    resize: none;
  }

  /* Buttons */
  .btn-primary {
    background: #4ca1af;
    border: none;
    transition: all 0.3s;
 }

  .btn-primary:hover {
    background: #1e3c72;
 }

 .btn-secondary {
    background: rgba(0, 0, 0, 0.5);
    border: none;
 }

  /* Table */
  .table {
    color: #fff;
    text-align: center;
  }

  .table thead {
    background: #4ca1af;
  }

 .table tbody tr:nth-child(even) {
    background: rgba(255, 255, 255, 0.1);
 }

 /* Modal */
 .modal-content {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border: none;
    backdrop-filter: blur(15px);
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.4);
    border-radius: 15px;
 }

 .modal-header, .modal-footer {
    border: none;
 }

 .btn-close {
    background: none;
    filter: invert(1);
 }

 /* Alert */
 .alert {
    border-radius: 10px;
    text-align: center;
 }

 /* Responsive */
  @media (max-width: 768px) {
    .container {
        padding: 15px;
    }
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
                    <form action="./index.php" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="titleEdit" id="titleEdit" placeholder="Enter Your Title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="descriptionEdit" id="descriptionEdit" placeholder="Enter Your Descripiton" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Updatd Notes</button>
                        <!-- main ek hidden ko pass karo ga apnay form ko after edit button update karany ka luey -->
                        <input type="hidden" name="snoEdit" id="snoEdit">
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
    <nav class="navbar navbar-expand-lg bg-success navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Notes_app</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- navbar End -->



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
    <!-- now my margin above container  -->
    <div class="container  my-4">
        <h1>Add a Notes</h1>
        <form action="./index.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" placeholder="Enter Your Title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" placeholder="Enter Your Description" id="description" class="form-control  your_summernote" rows="3"></textarea>
            </div>
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
                          <td>" . $row['description'] . "</td>
                          <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> 
                          <button class='delete btn btn-sm btn-primary' id=d".$row['sno'] . ">Delete</button></td>
                         </tr>";
                }
                ?>
            </tbody>
        </table>
        <hr>
    </div>















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- uay hamray pass css or js  hian data table ki -->
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>

    <!-- edit js -->
    <script src="js/edit.js"></script>
    <!-- Delete js -->
    <script src="js/delete.js"></script>

    <!-- Summernote JS - CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".your_summernote").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <!-- //Summernote JS - CDN Link -->


</body>
</html>