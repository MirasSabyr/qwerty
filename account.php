<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="register.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="account.css" rel="stylesheet">
</head>
<body>       

<?php

if ($_COOKIE['isAdmin']==0) {
  // Перенаправление на главную страницу 

  header('Location: index.php'); 

  exit; 
}

$host = 'localhost'; // имя хоста
$db_name = 'Trevel_Vista'; // имя базы данных
$user = 'root'; // имя пользователя
$db_password = ''; // пароль

// создание подключения к базе   
$link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");
// текст SQL запроса, который будет передан базе

if ($_COOKIE['auth']) {
  $log=$_COOKIE['login'];

  $query = "SELECT * FROM Users WHERE login = '$log'";
  $res = mysqli_query($link, $query);
  $user = mysqli_fetch_assoc($res);
  $id=$user['id'];
  $fName=$user['firstName'];
  $sName=$user['secondName'];

  echo "<h1>Профиль пользователя</h1>
  <p class='fName'>Имя пользователя: $fName</p>
  <p class='sName'>Фамилия пользователя: $sName</p>
  <button id='changePass'>Изменить Пароль</button>

  <form method='post' action='' class='passwordForm'>
    <label for='new_fname'>Новое имя пользователя:</label>
    <input type='text' id='new_fname' name='new_fname'>
    <label for='new_sname'>Новое имя пользователя:</label>
    <input type='text' id='new_sname' name='new_sname'>

    <label for='new_password'>Новый пароль:</label>
    <input type='password' id='new_password' name='new_password'>

    <input type='submit' value='Сохранить изменения'>
  </form>";

  $nFName=$_POST['new_fName'];
  $nSName=$_POST['new_sName'];
  $nPass=$_POST['new_password'];

  $query = "UPDATE Users SET firstName='$nFName', secondName='$nSName', password='$nPass' WHERE id=$id";
  $res = mysqli_query($link, $query);

  echo "<table>
  <tr>
    <th>Data 1</th>
    <th style='background-color: yellow'>Data 2</th>
  </tr>
  <tr>
    <td>Calcutta</td>
    <td style='background-color: yellow'>Orange</td>
  </tr>
  <tr>
    <td>Robots</td>
    <td style='background-color: yellow'>Jazz</td>
  </tr>
</table>";
}
else {
  echo "<p class='error'>Вы не авторизованы</p>";
}

?>

</body>
</html>