<?php
session_start();
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

    $query = "SELECT * FROM Users WHERE login='$log'  AND password='$pass'";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);
    if (!empty($user) && $user['isAdmin']) { 

        if (!isset($_COOKIE['isAdmin'])) { // если куки нет
            setcookie('isAdmin', 'true');
            $_COOKIE['isAdmin'] = 'true';
        }
        else {
            $_COOKIE['isAdmin'] = 'true';
        }
      if (!isset($_COOKIE['auth'])) { // если куки нет
        setcookie('auth', 'true');
        $_COOKIE['auth'] = 'true';
      }

      // Перенаправление на страницу администратора 

      header('Location: admin_panel.php'); 

      exit; 
    } 
    if (!empty($user)) {
        // прошел авторизацию
        $_COOKIE['auth'] = true;
        echo "Вы успешно авторизованы.<br>";
        header("Location: main/index.html");
    } else {
        // неверно ввели логин или пароль
        echo "Неверный логин или пароль.<br>";
    }
}

mysqli_close($link);
?>

</body>
</html>