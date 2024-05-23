<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="register.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
       
<form method="post" action="">
    <input type="text" class="f1" name="login" placeholder="Enter your Login">
    <input type="password" class="f2" name="password" placeholder="Enter your Password">
    <input type="password" class="f3" name="confirm" placeholder="Confirm Password">
    <input type="submit" class="p7" value="Отправить">
</form>

<?php


function checkPasswordStrength($password) {
  $errors = [];

  // Проверка на наличие хотя бы одного специального символа
  // $patern='#[!@#$%^&*()_+=\[\]{};:,.<>?]#'
  // if (!preg_match($patern, $password)) {
  //   $errors[] = "Пароль должен содержать хотя бы один специальный символ. $password";
  // }

  // Проверка на наличие хотя бы одной буквы в верхнем регистре
  if (!preg_match('/[A-ZА-ЯЁ]/', $password)) {
    $errors[] = "Пароль должен содержать хотя бы одну букву в верхнем регистре.";
  }

  //проверка на длины пароля
  if (mb_strlen($password)<6) {
    $errors[]="Пароль меньше шести символов.";
  }

  if (mb_strlen($password)>20) {
    $errors[]="Пароль больше двадцати символов.";
  }

  // Возвращаем массив ошибок, если они есть
  if (!empty($errors)) {
    return $errors;
  } else {
    return true;
  }
}


$host = 'localhost'; // имя хоста
$db_name = 'Trevel_Vista'; // имя базы данных
$user = 'root'; // имя пользователя
$db_password = ''; // пароль

// создание подключения к базе   
$link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");
// текст SQL запроса, который будет передан базе

if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $log = $_POST['login'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];
    if ($pass == $confirm) {
      $result = checkPasswordStrength($pass);
      echo "<p>$pass<p>";
      if ($result === true) {
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
        }
      else {
        echo "Пароль не соответствует требованиям. Ошибки: <br>";
        foreach ($result as $error) {
          echo "- " . $error . "<br>";
        }
      }
      

    } else {
        echo "Пароли не совпадают.<br>";
    }

}

?>

</body>
</html>