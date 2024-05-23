<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="products.css" rel="stylesheet">
    <title>Products</title>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
 // Получаем все элементы с классом 'product'
 var products = document.querySelectorAll('.product');
 // Добавляем обработчики событий для каждого товара
 products.forEach(function(product) {
 product.addEventListener('mouseenter', function() {
 // При наведении мыши показываем описание
 var description = this.querySelector('.description');
 description.style.display = 'block';
 setTimeout(function() { // Устанавливаем задержку для корректной работы анимации
 description.style.opacity = '1';
 }, 0);
 });
 product.addEventListener('mouseleave', function() {
 // Когда курсор уходит с товара, скрываем описание
 var description = this.querySelector('.description');
 description.style.opacity = '0';
 setTimeout(function() { // Устанавливаем задержку перед скрытием для корректной работы анимации
 description.style.display = 'none';
 }, 250); // Задержка равна продолжительности анимации
 });
 });
});

    </script>
</head>
<body>




<div class="box1">

    <img src="sigma9.png" alt="" class="box2">  
    <img src="sigma8.png" alt="" class="sign1">
    <a href="index.php"><img src="sigma12.png" alt="" class="arrow1"></a>
    <img src="sigma8.png" alt="Sign" class="sign2">
    <img src="sigma8.png" alt="Sign" class="sign3">
    <img src="sigma8.png" alt="Sign" class="sign4">
    <img src="sigma8.png" alt="Sign" class="sign5">
    <img src="sigma8.png" alt="Sign" class="sign6">


<?php
    $descriptionTop=['','Водоворотное масло','Штормовое масло','Громовое масло','Зелье ветряного барьера','Зелье изоляции'];
    $descriptionBottom=['','Увеличивает Гидро урон всех членов отряда на 25% на 300 сек.','Увеличивает Анемо урон всех членов отряда на 25% на 300 сек.','Увеличивает Электро урон всех членов отряда на 25% на 300 сек.','Увеличивает Анемо сопротивление всех членов отряда на 25% на 300 сек.','Увеличивает Электро сопротивление всех членов отряда на 25% на 300 сек.'];

    // Подключение к базе данных MySQL
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'mysql';

    $conn = mysqli_connect($host, $username, $password, $database);

    // Проверка соединения
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL-запрос для выборки информации о товарах
    $query = "SELECT id, name, price, is_available FROM products";
    $result = mysqli_query($conn, $query);

    // Проверка успешности запроса
    if ($result) {
        $i=1;
        // Перебор каждого товара
        while ($row = mysqli_fetch_assoc($result)) {
            $j=$i+5;
            // Проверка, есть ли товар в продаже
            if ($row['is_available'] == 0) {
                // Товар не в продаже, обновляем ценник на "off sale"
                
                echo "<p class='p$j'>off sale</p>";
            } else {
                // Товар в продаже, отображаем ценник
                echo "<p class='p$i'>" . $row['price'] . "</p><div class='product'><img src='sigma$i.png' alt='Product Image' class='potion$i'><div class='description'><div class='dbox$i'><p class='dp$i'>" . $descriptionTop[$i] . "</p><p class='dp$j'>" . $descriptionBottom[$i] . "</p></div></div></div>";
            }
            $i++;
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Закрытие соединения
    mysqli_close($conn);
?>




</div>
</body>
</html>