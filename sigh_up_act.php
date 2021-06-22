<?php
include('functions.php');

$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$addres = $_POST["addres"];
$phone = $_POST["phone"];

$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM users_table WHERE user_name=:user_name';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}

if ($stmt->fetchColumn() > 0) {
    echo "<p>すでに登録されているユーザです．</p>";
    echo '<a href="log_in.php">login</a>';
    exit();
}

$sql = 'INSERT INTO users_table(id, user_name, mail, password, addres, phone, created_at, updated_at) VALUES(NULL, :user_name, :mail, :password, :addres, :phone, sysdate(), sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':addres', $addres, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:log_in.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>

</body>

</html>