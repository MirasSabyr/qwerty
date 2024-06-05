<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="register.css" rel="stylesheet">
    <!--Stylesheet-->
    <h1 id="myText" class="myText">Готов к путешествию?</h1>
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body {
    background-image: url(/travel.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    height: 100vh; 
    width: 100%; 
}
form{
    height: 520px;
    width: clamp(300px, 60%, 500px);
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #000000;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}

::placeholder{
    color: #000000;
    font-family: cursive;
}
.f6{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

    </style>
</head>
<body>
    <form method="post" action="">
    <h3>Sign Up</h3>
    <input type="text" class="f1" name="login" placeholder="Enter your Login" value="">
    <input type="password" class="f2" name="password" placeholder="Enter your Password">
    <input type="password" class="f3" name="confirm" placeholder="Confirm Password">
    <input type="text" class="f4" name="firstName" placeholder="Your First Name">
    <input type="text" class="f5" name="secondName" placeholder="Your Second Name">
    <input type="submit" class="f6" value="Sign Up">
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
          $query = "SELECT * FROM Users WHERE login = '$log'";
          $res = mysqli_query($link, $query);
          $user = mysqli_fetch_assoc($res);

          if (empty($user)) { 
            $fName=$_POST['firstName'];
            $sName=$_POST['secondName'];
            $query = "INSERT INTO Users(login, password, firstName, secondName) VALUES (?, ?, ?, ?)"; 
            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, 'ssss', $log, $pass, $fName, $sName);
            mysqli_stmt_execute($stmt);
            if (!isset($_COOKIE['auth'])) { // если куки нет
              setcookie('auth', 'true');
              $_COOKIE['auth'] = 'true';
            }
            else $_COOKIE['auth'] = 'true';
            header("Location: main/index.html");         
          } 
          else{echo "<p class='error'>Логин занят.</p><br>";} 
          } 
        else { 
          echo "<p class='error'>Пароль не соответствует требованиям. Ошибки: </p><br>"; 
          foreach ($result as $error) { 
            echo "<p class='error'>- " . $error . "</p><br>"; 
          } 
        } 
        

      } else { 
          echo "<p class='error'>Пароли не совпадают.</p><br>"; 
      } 

    }
    ?>
</body>
</html>