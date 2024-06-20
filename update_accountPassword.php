<?php
$id=$_POST['userId'];
$nPass=$_POST['new_password'];
$cPass=$_POST['comfirm_password'];

if (!empty($nPass) and !empty($cPass)) {
    function checkPasswordStrength($password) {
        $errors = [];
  
        // Проверка на наличие хотя бы одного специального символа
        $pattern = '/[!@#$%^&*()_+=\[\]{}\'"|\/;:,.<>?]/';
        if (!preg_match($pattern, $password)) {
            $errors[] = "<span class=\"error\">Пароль должен содержать хотя бы один специальный символ.</span>";
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

    $query = "SELECT * FROM Users WHERE id = $id";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);
    if ($cPass==$user['password']) {
        $result = checkPasswordStrength($nPass); 
        if ($result===true) {
        $query = "UPDATE Users SET password='$nPass' WHERE id=$id";
        $res = mysqli_query($link, $query);
        header("Location: account.php");
        exit;
        }
        else {
        header("Location: account.php?error='Вы не правильно вели старый пароль'");
        exit;}
    }
} else{
    header("Location: account.php?error='Вы не правильно вели старый пароль'");
    exit;}
?>