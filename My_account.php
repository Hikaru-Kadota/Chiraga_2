<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['id'];

$sql = 'SELECT * FROM users_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
  $output = "";
  $output .= "<div>ユーザー名：{$record["user_name"]}</div>";
  $output .= "<div>メールアドレス：{$record["mail"]}</div>";
  $output .= "<div>住所：{$record["address"]}</div>";
  $output .= "<div>電話番号：{$record["phone"]}</div>";
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
  <a href="My_page.php">他のユーザーの出品商品一覧ページへ</a>
  <fieldset>
    <legend>自分の出品商品</legend>
    <a href="Item_input.php">新規出品</a>
    <a href="log_out.php">ログアウト</a>
    <table>
      <thead>
        <tr>
          <th>商品名</th>
          <th>メーカー</th>
          <th>サイズ</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>