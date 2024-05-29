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
      <input type="hidden" id="departure-date" name="departure-date" value="<?php echo $_POST['departure-date']; ?>">
      <input type="hidden" id="adults" name="adults" value="<?php $adults=$_POST['adults']; echo $adults; ?>">
      <input type="hidden" id="children" name="children" value="<?php $children=$_POST['children']; echo $children; ?>">




      <label>Отель:</label>
      <input list="hotels" name="hotel" required>
      <datalist id="hotels">
        <!-- создать столько количество <option> сколько записано, в стране $_POST['to'], в базе данных Trevel_Vista, в таблице Hotels, а также записать в <option value=''>  имя отеля -->
        <?php
        $host = 'localhost'; // имя хоста
        $db_name = 'Trevel_Vista'; // имя базы данных
        $user = 'root'; // имя пользователя
        $db_password = ''; // пароль
    
        // создание подключения к базе   
        $link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
        mysqli_query($link, "SET NAMES 'utf8'");
        $country=$_POST['to'];
        // Ваш SQL-запрос
        $sql = "SELECT * FROM Hotels WHERE country = '$country'";

        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            // Обработка результатов запроса
            while ($row = $result->fetch_assoc()) {
                // Другие поля, которые вы хотите вывести
                echo "<option value='".$row['name']."'>".$row['stars']." звезд;"." стоимость за ночь: ". $row['costPerNight']."</option>";
            }
            
        } else {
            echo "Нет данных об отелях в указанной стране.";
        }
        $link->close();
        
        echo "</datalist><br><label for='days'>Дней проживание:</label>
        <br><input type='number' id='days' name='days' min=1 max=30 value=1>
        <br><label for='nights'>Ночей проживание:</label>
        <br><input type='number' id='nights' name='nights' min=0 max=30 value=0>
        <br><label for='adultsLogin'>Логин аккаунтов взрослых:</label>";
        // <!-- создать столько количество <input> сколько записано $_POST['adults']-->
        for ($i=0; $i < $adults; $i++) { 
            echo "<br><input type='text' id='adultsLogin' name='adultLogin' required>";
        }
        echo "<br><label for='childrenLogin'>Логин аккаунтов детей:</label>";
        // <!-- создать столько количество <input> сколько записано $_POST['children']-->
        for ($i=0; $i < $children; $i++) { 
            echo "<br><input type='text' id='childrenLogin' name='childrenLogin' required>";
        }
      ?>
      <br><br><input type="submit" value="Забронировать поездку">
  </form>
</body>
</html>
<?php
include "base.php";
?>