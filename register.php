<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="register.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<div class="sbox1"></div>

<img src="sigma10.png" alt="Scroll" class="scroll">

<p class="p4">Registration</p>
<p class="p1">Login</p>
<p class="p2">Password</p>
<p class="p3">Comfirm Password</p>

<a href='index.php'><img src="sigma11.png" alt="Exit" class="crest"></a>
        
<form method="get" action="">
    <input type="text" class="f1" name="login" placeholder="Enter your Login">
    <input type="password" class="f2" name="password" placeholder="Enter your Password">
    <input type="password" class="f3" name="confirm" placeholder="Confirm Password">
    <input type="submit" class="p7" value="Отправить">
</form>
<?php
$host = 'localhost'; // имя хоста
$db_name = 'Trevel_Vista'; // имя базы данных
$user = 'root'; // имя пользователя
$db_password = ''; // пароль

// создание подключения к базе   
$link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");
// текст SQL запроса, который будет передан базе

if (!empty($_GET['login']) and !empty($_GET['password'])) {
    $log = $_GET['login'];
    $pass = $_GET['password'];
    $confirm = $_GET['confirm'];
    if ($pass == $confirm) {
      $query = "SELECT * FROM Пользователи WHERE login='$log' AND password='$pass'";
      $res = mysqli_query($link, $query);
      $user = mysqli_fetch_assoc($res);

      if (empty($user)) {

        $query = "INSERT INTO Пользователи(login, password) VALUES ('$log','$pass')";
        mysqli_query($link, $query);
        $_SESSION['auth'] = true;
        echo "Удачная регистрация.<br>";
      }
      else{echo "Неудачная регистрация.<br>";}

    } else {
        echo "Пароли не совпадают.<br>";
    }

}

?>

</body>
</html>