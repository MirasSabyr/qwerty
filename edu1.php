<?php
$dbhost = 'localhost';
$dbuser= 'newuser';
$dbpass = 'password';
$conn = mysqli_connect($dbhost , $dbuser , $dbpass,);
if(!$conn){
        die('Could not connect:'.mysqli_error($conn));
}
mysqli_select_db($conn);
mysqli_close($conn);
?>