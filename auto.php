<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="register.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization</title>
</head>
<body>
     
<form method="post" action="auto.php">
    <input type="text" class="f1" name="login" placeholder="Вводите Логин">
    <input type="password" class="f3" name="password" placeholder="Вводите Пароль">
    <input type="submit" class="f4" value="Отправить">
</form>

<?php
$host = 'localhost'; // имя хоста
$db_name = 'Trevel_Vista'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

// создание подключения к базе   
$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");
// текст SQL запроса, который будет передан базе

if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $log = $_POST['login'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM Пользователи WHERE login='$log'  AND password='$pass'";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);
    if (!empty($user) && $user['isAdmin']) { 

      $_SESSION['is_admin'] = true; 
      $_SESSION['auth'] = true;

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