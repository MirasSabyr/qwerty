<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="register.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization</title>
</head>
<body>
<div class="sbox1"></div>

<img src="sigma10.png" alt="Scroll" class="scroll">

<p class="p5">Authorization</p>
<p class="p1">Login</p>
<p class="p2">Password</p>

<a href='index.php'><img src="sigma11.png" alt="Exit" class="crest"></a>
        
<form method="get" action="">
    <input type="text" class="f1" name="login" placeholder="Enter your Login">
    <input type="password" class="f2" name="password" placeholder="Enter your Password">
    <input type="submit" class="p6" value="Отправить">
</form>

<?php
$host = 'localhost'; // имя хоста
$db_name = 'mysql'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

// создание подключения к базе   
$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");
// текст SQL запроса, который будет передан базе

if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM alisite WHERE login='$login' AND password='$pass'";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);
    if (!empty($user) && $user['is_admin']) { 

      $_SESSION['is_admin'] = true; 

      // Перенаправление на страницу администратора 

      header('Location: admin_panel.php'); 

      exit; 
    } 
    if (!empty($user)) {
        // прошел авторизацию
        $_SESSION['auth'] = true;
        echo "Вы успешно авторизованы.<br>";
    } else {
        // неверно ввели логин или пароль
        echo "Неверный логин или пароль.<br>";
    }
}

mysqli_close($link);
?>

</body>
</html>