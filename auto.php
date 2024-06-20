<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="auto.css" rel="stylesheet">
    <!--Stylesheet-->
    <h1 id="myText" class="myText">Приключение ждет...</h1>
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
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
    <?php session_start(); ?>

    <form method="post" action="">
    <h3>Login Here</h3>
    <input type="text" class="f1" name="login" placeholder="Enter your Login" value="">
    <input type="password" class="f2" name="password" placeholder="Enter your Password">
    <input type="submit" class="f6" value="log In">
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

    function cook($login){
    if (!isset($_COOKIE['auth'])) { // если куки нет
        setcookie('auth', 'true');
        $_COOKIE['auth'] = 'true';
    } else $_COOKIE['auth'] = 'true';
    // if (!isset($_COOKIE['login'])) { // если куки нет
    //     setcookie('login', "$login");
    //     $_COOKIE['login'] = "$login";
    // } else $_COOKIE['login'] = "$login";
    $_SESSION['login']="$login";
    }



    if (!empty($_POST['login']) and !empty($_POST['password'])) {
        $log = $_POST['login'];
        $pass = $_POST['password'];

        $query = "SELECT * FROM Users WHERE login='$log'  AND password='$pass'";
        $res = mysqli_query($link, $query);
        $user = mysqli_fetch_assoc($res);
        if (!empty($user) && $user['isAdmin']) { 
            $_SESSION['isAdmin'] = 'true';
            cook($log);

            // Перенаправление на страницу администратора 
            header('Location: admin_panel.php'); 
            exit(); 
        } 
        if (!empty($user)) {
            // прошел авторизацию
            cook($log);
            header("Location: index.html");
            //exit();
        } else {
            echo "<p class='error'>Неверный логин или пароль.</p><br>";
        }
    }

    mysqli_close($link);
    ?>
</body>
</html>
</body>
</html>