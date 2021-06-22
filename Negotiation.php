<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$my_item_id = $_GET['my_item_id'];
$target_item_id = $_GET['target_item_id'];
$user_name = $_SESSION['user_name'];

$sql = 'SELECT * FROM item_table WHERE id = :my_item_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':my_item_id', $my_item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $My_result = $stmt->fetchALL(PDO::FETCH_ASSOC);
  var_dump($My_result);
}

$sql = 'SELECT * FROM item_table WHERE id = :target_item_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':target_item_id', $target_item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $Target_result = $stmt->fetchALL(PDO::FETCH_ASSOC);
  var_dump($Target_result);
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
  <style>
    a {
      margin: 0 10px;
    }
  </style>
</head>

<body>
  <p>現在のユーザー [<?= $user_name ?>]</p>
  <a href="List.php">他のユーザーの出品商品一覧ページへ</a>
  <a href="My_list.php">自分の出品商品一覧ページへ</a>
  <fieldset>
    <legend>自分の出品商品 詳細</legend>
    <div>
    </div>
    <div><?= $Target_output ?></div>
  </fieldset>
</body>

</html>