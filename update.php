<?php
// var_dump($_POST);
// exit();
session_start();
include('functions.php');
check_session_id();

$pdo = connect_to_db();
// exit('ok');

if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['mail']) || $_POST['mail'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' ||
    !isset($_POST['addres']) || $_POST['addres'] == '' ||
    !isset($_POST['phone']) || $_POST['phone'] == ''
) {

    // exit('ok');
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

// exit('ok');

$user_name = $_POST['user_name'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$addres = $_POST['addres'];
$phone = $_POST['phone'];
$id = $_POST['id'];
// exit('ok');
$pdo = connect_to_db();

try {
    $pdo = new PDO('mysql:dbname=chiraga;charset=utf8;port=3306;host=localhost', 'root', '');
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}
// exit('ok');

$sql = 'UPDATE users_table SET user_name=:user_name, mail=:mail, addres=:addres, password=:password, phone=:phone, created_at=sysdate(), updated_at=sysdate() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':addres', $addres, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($status);
// exit();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('QueryError:' . $error[2]);
} else {
    header("Location:select.php");
    exit;
}
