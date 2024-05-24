<?php
session_start();
if ($_SESSION['is_admin']) {
    $host = 'localhost'; // имя хоста
    $db_name = 'Trevel_Vista'; // имя базы данных
    $user = 'root'; // имя пользователя
    $db_password = ''; // пароль

    // создание подключения к базе   
    $link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
    mysqli_query($link, "SET NAMES 'utf8'");
    // текст SQL запроса, который будет передан базе
 // Получение данных из формы
//  $product_id = $_POST['product_id'];
//  $new_price = $_POST['new_price'];
//  $is_available = $_POST['is_available'];
 $admin_id = $_POST['admin_id'];
 // Обновление информации о товаре
//  $query = "UPDATE products SET price = '$new_price', is_available = '$is_available' WHERE id = '$product_id'";
 $query = "UPDATE Users SET is_admin = 1ццццццццццццццц WHERE id='$admin_id'";
 mysqli_query($link, $query);
 // Перенаправление обратно на страницу администратора
 header('Location: admin_panel.php');
 exit;
}
?>