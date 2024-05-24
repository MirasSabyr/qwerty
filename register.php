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
    <input type="text" class="f1" name="login" placeholder="Enter your Login" value="">
    <input type="password" class="f2" name="password" placeholder="Enter your Password">
    <input type="password" class="f3" name="confirm" placeholder="Confirm Password">
    <input type="submit" class="p7" value="Отправить">
</form>

<?php
include "base.php";

function checkPasswordStrength($password) {
  $errors = [];

  // Проверка на наличие хотя бы одного специального символа
  $patern='/[!@#$%^&*()_+=\[\]{}\'"|\/;:,.<>?]/';
  if (!preg_match($patern, $password)) {
    $errors[] = "Пароль должен содержать хотя бы один специальный символ.";
  }

  // Проверка на наличие хотя бы одной буквы в верхнем регистре
  if (!preg_match('/[A-ZА-ЯЁ]/', $password)) {
    $errors[] = "Пароль должен содержать хотя бы одну букву в верхнем регистре.";
  }

  // Проверка на наличие хотя бы одной цифры
  if (!preg_match('/[0-9]/', $password)) {
    $errors[] = "Пароль должен содержать хотя бы одну цифру.";
  }

  //проверка на длины пароля
  if (mb_strlen($password)<6) {
    $errors[]="Пароль не меньше шести символов.";
  }

  if (mb_strlen($password)>20) {
    $errors[]="Пароль не больше двадцати символов.";
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
    if ($result === true) { 
      $query = "SELECT * FROM Users WHERE login = ?";
      $stmt = mysqli_prepare($link, $query);
      mysqli_stmt_bind_param($stmt, 's', $log);
      mysqli_stmt_execute($stmt);
      $res = mysqli_stmt_get_result($stmt);
      $user = mysqli_fetch_assoc($res);

      if (empty($user)) { 
        $query = "INSERT INTO Users(login, password) VALUES (?, ?)"; 
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $log, $pass);
        mysqli_stmt_execute($stmt);
        $_SESSION['auth'] = true; 
        echo "Удачная регистрация.<br>"; 
      } 
      else{echo "Логин занят.<br>";} 
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