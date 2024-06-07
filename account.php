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
session_start();
include "base.php";

$host = 'localhost'; // имя хоста
$db_name = 'Trevel_Vista'; // имя базы данных
$user = 'root'; // имя пользователя
$db_password = ''; // пароль

// создание подключения к базе   
$link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");
// текст SQL запроса, который будет передан базе

if ($_COOKIE['auth']==true) {
  $log=$_SESSION['login'];
  if ($_SESSION['login']==NULL) {
    $_COOKIE['error']="логин пуст";
    header("Location: main/index.html"); exit();
  }

  $query = "SELECT * FROM Users WHERE login = '$log'";
  $res = mysqli_query($link, $query);
  $user = mysqli_fetch_assoc($res);
  $id=$user['id'];
  $fName=$user['firstName'];
  $sName=$user['secondName'];
  $pass=$user['password'];

  echo "<h1>Профиль пользователя</h1>
  <p class='fName'>Имя пользователя: $fName</p>
  <p class='sName'>Фамилия пользователя: $sName</p>
  <button id='changeNames'>Изменить имя/фамилия</button>
  <button id='changePass'>Изменить Пароль</button>

  <form method='post' action='' class='nameForm'>
  <label for='new_fname'>Новое имя пользователя:</label><br>
  <input type='text' id='new_fname' name='new_fname'><br>
  <label for='new_sname'>Новое фамилия пользователя:</label><br>
  <input type='text' id='new_sname' name='new_sname'><br>
  <br><input type='submit' value='Сохранить изменения'>
  </form>
  
  <form method='post' action='' class='passwordForm'>
    <br><label for='new_password'>Новый пароль:</label><br>
    <input type='password' id='new_password' name='new_password'><br>
    <label for='new_password'>Старый пароль:</label><br>
    <input type='password' id='comfirm_password' name='comfirm_password'><br>

    <br><input type='submit' value='Сохранить пароль'>
  </form>";

  $nFName=$_POST['new_fName'];
  $nSName=$_POST['new_sName'];
  $nPass=$_POST['new_password'];
  $cPass=$_POST['comfirm_password'];
  if (!empty($nFName) and !empty($nSName) and !empty($nPass) and !empty($cPass)) {
    if ($cPass=$pass) {
    $query = "UPDATE Users SET firstName='$nFName', secondName='$nSName', password='$nPass' WHERE id=$id";
    $res = mysqli_query($link, $query);
    } else "Вы не правильно вели старый пароль";
  }
  
  echo "<h2>Ваши билеты</h2>
  <table><tr>
    <th>Аэропорт:</th>
    <th>Страна назначения:</th>
    <th>Отель проживание:</th>
    <th>Стоймость:</th>
    <th>Дни проживание:</th>
    <th>Ночи проживание:</th>
    <th>Время вылета:</th>
    <th>Время посадки:</th>
    <th>Турист-</th>
    <th>Билет также связан с:</th></tr>";

  $query = "SELECT * FROM Tickets WHERE userId = '$id' ORDER BY id DESC";
  $res = mysqli_query($link, $query);


  

  while ($ticket = mysqli_fetch_assoc($res)) {
    $from=$ticket['airport'];
    $to=$ticket['country'];
    $hotel=$ticket['hotel'];
    $cost=$ticket['cost'];
    $days=$ticket['days'];
    $nights=$ticket['nights'];
    $dTime=$ticket['departureTime'];
    $lTime=$ticket['landingTime'];
    $linksStr=$ticket['links'];
    $linksId = explode(",", $linksStr);
    $links="";

    foreach ($linksId as $i => $linkId) {
    $query2 = "SELECT * FROM Users WHERE id = '$linkId'";
    $res2 = mysqli_query($link, $query2);
    $user = mysqli_fetch_assoc($res2);
    $links.=$user['firstName']." ".$user['secondName'].",";
    }
    if (!empty($links)) $links = substr($links,0,-1);

    if ($ticket['isAdult']==1 and $ticket['isHaveLinks']==1) $userIs="Родитель";
    if ($ticket['isAdult']==1 and $ticket['isHaveLinks']==0) $userIs="Взрослый";
    if ($ticket['isAdult']==0 and $ticket['isHaveLinks']==1) $userIs="Ребёнок";
    if ($ticket['isAdult']==0 and $ticket['isHaveLinks']==0) $userIs="Студент";
    
    
    echo "<tr> <td>$from</td>
    <td>$to</td>
    <td>$hotel</td>
    <td>$cost</td>
    <td>$days</td>
    <td>$nights</td>
    <td>$dTime</td>
    <td>$lTime</td>
    <td>$userIs</td>
    <td>$links</td></tr>";
  }

  echo "</table>";
}
else {
  echo "<p class='error'>Вы не авторизованы</p>";
}

?>

</body>
</html>