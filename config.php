<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$servername="localhost";
    $userName="root";
    $password="";
    $dbName='miniproject';
    $conn=mysqli_connect($servername,$userName,$password,$dbName);
 
// Check connection
if($conn == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>