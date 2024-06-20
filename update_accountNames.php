<?php
$id=$_POST['userId'];
$nFName=$_POST['new_fName'];
$nSName=$_POST['new_sName'];

$host = 'localhost'; // имя хоста
$db_name = 'Trevel_Vista'; // имя базы данных
$user = 'root'; // имя пользователя
$db_password = ''; // пароль
// создание подключения к базе   
$link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");

if (!empty($nFName) and !empty($nSName)) {
    // текст SQL запроса, который будет передан базе
    $query = "UPDATE Users SET firstName='$nFName', secondName='$nSName' WHERE id=$id";
    $res = mysqli_query($link, $query);
    header("Location: account.php");
    exit;
}

if (!empty($nFName) and empty($nSName)) {
    // текст SQL запроса, который будет передан базе
    $query = "UPDATE Users SET firstName='$nFName' WHERE id=$id";
    $res = mysqli_query($link, $query);
    header("Location: account.php");
    exit;
}

if (empty($nFName) and !empty($nSName)) {
    // текст SQL запроса, который будет передан базе
    $query = "UPDATE Users SET secondName='$nSName' WHERE id=$id";
    $res = mysqli_query($link, $query);
    header("Location: account.php");
    exit;
}
?>