<?php
// var_dump($_GET);
// exit;

$id = $_GET['id'];

session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();

// exit('ok');

try {
    $pdo = new PDO('mysql:dbname=chiraga;charset=utf8;port=3306;host=localhost', 'root', '');
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

$sql = 'DELETE FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
} else {
    header("Location:select.php");
    exit;
}
