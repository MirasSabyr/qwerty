<?php
session_start();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="siteali.css" rel="stylesheet">
    <title>MainPage</title>
    <script>
    document.getElementById("mainButton").addEventListener("click", function() {
      var additionalButtons = document.getElementById("additionalButtons");
      additionalButtons.classList.toggle("show");
    });
    </script>
</head>
<body>

<div class="sbox1">
<img src="sigma6.png" alt="" class="sdiona">
<img src="sigma8.png" alt="" class="ssign1">
<p class="sp1">cat's tail<br> tavern</p>
<img src="sigma8.png" alt="" class="ssign2">
<img src="sigma8.png" alt="" class="ssign3">
<a class="sp3" href="products.php">products</a>
<img src="sigma9.png" alt="" class="swardrobe">

<?php
if (empty($_SESSION['auth'])) {
    echo "<a class='sp2' id='mainButton'>log in</a>
    <div id='additionalButtons'>
    <a href='page1.html' class='sa1'>Перейти на страницу 1</a>
    <a href='page2.html' class='sa2'>Перейти на страницу 2</a>
    </div>
    <div class='sd1'><a href='auto.php' class='sdb1'>Authorization</a></div><div class='sd2'><a href='register.php' class='sdb2'>Registration</a></div>";
    
}
else {
  echo '<a class="sp4" href="exit.php">log out</a>';
}
?>

</div>


</body>
</html>