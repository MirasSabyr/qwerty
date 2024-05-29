<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- вторая форма запроса, которая дополняет первую -->
<form action="update_ticket.php" method="post">

      <input type="hidden" id="from" name="from" value="<?php echo $_POST['from'] ?>">
      <input type="hidden" id="to" name="to" value="<?php echo $_POST['to'] ?>">
      <input type="hidden" id="departure-date" name="departure-date" value="<?php echo $_POST['departure-date'] ?>">
      <input type="hidden" id="adults" name="adults" value="<?php echo $_POST['adults'] ?>">
      <input type="hidden" id="children" name="children" value="<?php echo $_POST['children'] ?>">




      <label for="hotels">Отель:</label>
      <select name="hotel" id="hotels">
        <!-- создать столько количество <option> сколько записано, в стране $_POST['to'], в базе данных Trevel_Vista, в таблице Hotels, а также записать в <option value=''>  имя отеля -->
            <?php
        $host = 'localhost'; // имя хоста
        $db_name = 'Trevel_Vista'; // имя базы данных
        $user = 'root'; // имя пользователя
        $db_password = ''; // пароль
    
        // создание подключения к базе   
        $link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
        mysqli_query($link, "SET NAMES 'utf8'");
        <option value="hotel">hotel</option>
        echo `</select><label for="adults">Логин аккаунтов взрослых:</label>`
        // <!-- создать столько количество <input> сколько записано $_POST['adults']-->
        $for=$_POST['adults'];
        for ($i=0; $i < $for; $i++) { 
            # code...
        }
        echo `<input type="text" id="adults" name="userLogin" required><label for="children">Логин аккаунтов детей:</label>`
        // <!-- создать столько количество <input> сколько записано $_POST['children']-->
        $for=$_POST['children'];
        for ($i=0; $i < $for; $i++) { 
            # code...
        }
      <input type="text" id="children" name="userLogin" required>
      ?>
      <button type="submit">Забронировать поездку</button>
  </form>
</body>
</html>
<?php
include "base.php";
?>