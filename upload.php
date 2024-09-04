<link type="text/css" rel="stylesheet" href="stylesheet.css">
<?php 
include 'config.php';
session_start();
 
// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: student_login.php");
    exit;
}

# retrieve file title
$title = $_POST["title"]; 
$pac = $_POST["pac"];
$regdno = $_SESSION["num"];

# file name with a random number so that similar ones don't get replaced
$pname = rand(1000, 10000) . "-" . $_FILES["file"]["name"];

# temporary file name to store file
$tname = $_FILES["file"]["tmp_name"];

# upload directory path
$uploadPath = "uploaded_files/";

# create the directory if it doesn't exist
if (!file_exists($uploadPath)) {
    mkdir($uploadPath, 0755, true);
}

# move the uploaded file to the specific location
if (move_uploaded_file($tname, $uploadPath . $pname)) {
    # sql query to insert into the database
    $sql = "INSERT INTO package (regdno, companyname, package, file) VALUES ('$regdno', '$title', '$pac', '$pname')";

    if (mysqli_query($conn, $sql)) {
        echo "File successfully uploaded";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        ?>
        <a href="update_placement.php" class="button">Back</a>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error uploading file.";
}
?>
