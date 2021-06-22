<?php
// var_dump($_POST);
// exit();

include('functions.php');

if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['mail']) || $_POST['mail'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' ||
    !isset($_POST['address']) || $_POST['address'] == '' ||
    !isset($_POST['phone']) || $_POST['phone'] == ''
) {
    exit('Param Error');
}
// exit('ok');


$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$address = $_POST["address"];
$phone = $_POST["phone"];
// exit('ok');

// DB接続
$pdo = connect_to_db();
// var_dump($phone);
// exit();
// DB接続
// try {
//     $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//     echo json_encode(["db error" => "{$e->getMessage()}"]);
//     exit();
// }
// exit('ok');

$sql = 'INSERT INTO users_table (id, user_name, mail, password, address, phone, created_at, updated_at)VALUES  (NULL, :user_name, :mail, :password, :address, :phone, sysdate(), sysdate())';
// var_dump($sql);
// exit();

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$status = $stmt->execute();



// exit('ok');

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    header('Location:my_page.php');
}
