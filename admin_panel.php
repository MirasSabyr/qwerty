<?php
session_start();
if ($_SESSION['is_admin']) { 

// Показать интерфейс администратора 

// Форма для изменения цены и статуса товара 

echo "<form method='post' action='update_product.php'> 

    <input type='number' name='product_id' placeholder='ID товара'> 

    <input type='number' name='new_price' placeholder='Новая цена'> 

    <select name='is_available'> 

        <option value='1'>В наличии</option> 

        <option value='0'>Нет в наличии</option> 

    </select> 

    <input type='submit' value='Обновить'> 

</form>
<form method='post' action='update_product.php'><input type='text' name='admin_id' placeholder='ID пользователя'><input type='submit' value='Дать права администратора'> </form>
<a href='exit.php' style='color:red;'>Выход</a>
"; 

} else { 

// Перенаправление на главную страницу 

header('Location: index.php'); 

exit; 

}
?>