<?php
include 'config.php';
session_name("hod");
session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: hod_login.php");
    exit;
}

$backlog = $_POST['backlogs'];
$cgpa = $_POST['cgpa'];
$company = $_POST['company'];
$sql = "SELECT * FROM marks WHERE cgpa >= '$cgpa' AND backlogs <= '$backlog'";
$_SESSION["cgpa"] = $cgpa;
$_SESSION["backlog"] = $backlog;
$_SESSION["company"] = $company;
$result = $conn->query($sql);

// declare an array to store the data from the database
$row = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css">
    <style>
        td,
        th {
            border: 1px solid black;
            padding: 10px;
            margin: 5px;
            text-align: center;
        }
    </style>
</head>

<body style="background: color #959595;">
    <p style="text-align:right;">
        <a href="student_logout.php" class="button" align='right'><img src="signout.jpg" alt="signout" width="20" height="20"></a>
    </p>
    <table border='3' cellspacing="0" align="center" style="background: color #757575;">
        <thead>
            <tr>
                <th>Company</th>
                <th>Regdno</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>D.O.B</th>
                <th>Backlogs</th>
                <th>CGPA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($row)) {
                foreach ($row as $rows) {
                    ?>
                    <tr>
                        <td><?php echo $company; ?></td>
                        <td><?php echo $rows['regdno'];
                            $n = $rows['regdno'];
                            $sql1 = "SELECT * FROM student WHERE regdno='$n'";
                            $result1 = $conn->query($sql1);

                            while ($rows1 = $result1->fetch_assoc()) {
                                ?>
                                <td><?php echo $rows1['name']; ?></td>
                                <td><?php echo $rows1['contact']; ?></td>
                                <td><?php echo $rows1['email']; ?></td>
                                <td><?php echo $rows1['dob']; ?></td>
                            <?php } ?>

                        <td><?php echo $rows['backlogs']; ?></td>
                        <td><?php echo $rows['cgpa']; ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>

</body>

</html>

<?php
mysqli_close($conn);
?>
