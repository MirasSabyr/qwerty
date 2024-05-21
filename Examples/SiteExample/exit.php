<?php
session_start();
$_SESSION['auth'] = false;
header('Location: index.php', true, 301);
exit();
?>