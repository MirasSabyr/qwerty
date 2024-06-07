<?php
session_start();

if (isset($_COOKIE['auth'])) {
    setcookie('auth', '', time());
    unset($_COOKIE['auth']);
}
$_SESSION['login']=NULL;
$_SESSION['isAdmin']=false;
header('Location: main/index.html', true, 301); exit();
?>