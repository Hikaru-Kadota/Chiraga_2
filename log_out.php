<?php
session_start(); // セッションの開始
$_SESSION = array(); // セッション変数を空の配列で上書き 
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
header('Location:log_in.php');
exit();
