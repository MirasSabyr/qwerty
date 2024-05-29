<?php
session_start();
$_COOKIE['auth'] = false;
header('Location: index.php', true, 301);
exit();
?>