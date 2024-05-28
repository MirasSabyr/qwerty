<?php
session_start();
if ($_COOKIE['isAdmin']) {
    $host = 'localhost'; // имя хоста
    $db_name = 'Trevel_Vista'; // имя базы данных
    $user = 'root'; // имя пользователя
    $db_password = ''; // пароль

    // создание подключения к базе   
    $link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
    mysqli_query($link, "SET NAMES 'utf8'");

    if (!empty($_POST['changeAdmin'])) {
        $userId = $_POST['userId_toChangeAdmin'];
        $boolSetting = $_POST['changeAdmin'];
        $_GET['error']=$_POST['changeAdmin'];

        // Проверка, является ли значение $boolSetting 0 или 1
        if ($boolSetting == 0 || $boolSetting == 1) {
            $query = "UPDATE Users SET isAdmin=$boolSetting WHERE id=$userId";
            mysqli_query($link, $query);
        } else {
            $_GET['error']="Invalid admin status. Please use 0 (remove admin rights) or 1 (add admin rights).";
        }
    }
 
    // Перенаправление обратно на страницу админа
    header("Location: admin_panel.php?error='$_POST[changeAdmin]'");
    exit;
}
?>
