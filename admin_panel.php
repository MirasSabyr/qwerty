<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="admin_panel.css" rel=stylesheet>
</head>
<body>
    <h1>Админ панель</h1>
<?php
session_start();
if (!$_COOKIE['isAdmin']) {
// Перенаправление на главную страницу 
header('Location: index.php'); 
exit; 
}
?>

<!-- Показать интерфейс администратора  -->

<!-- Форма для изменения цены и статуса товара  -->

<form method='post' action='update_product.php'> 

    <input type='number' name='product_id' placeholder='ID товара'> 

    <input type='number' name='new_price' placeholder='Новая цена'> 

    <select name='is_available'> 

        <option value='1'>В наличии</option> 

        <option value='0'>Нет в наличии</option> 

    </select> 

    <input type='submit' value='Обновить'> 

</form>
<form method='post' action='update_product.php'><input type='text' name='userId_toChangeAdmin' placeholder='ID пользователя'>
<input type='number' min=0 max=1 name='changeAdmin'>
<label for='changeAdmin'><?php if (isset($_POST['changeAdmin'])) echo $_POST['changeAdmin'] ?> 0 - убрать права; 1 - дать права</label>
<input type='submit' value='Изменить права администратора'> </form>
<a href='exit.php' style='color:red;'>Выход</a>
</body>
</html>