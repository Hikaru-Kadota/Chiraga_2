<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$id = $_GET["id"];

$sql = 'SELECT * FROM item_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アイテム情報編集画面</title>
</head>

<body>
  <form action="Item_update.php" method="POST">
    <fieldset>
      <legend>アイテム編集画面</legend>
      <a href="My_list.php">一覧画面</a>
      <div>
        タイトル: <input type="text" name="item_name" value="<?= $record["item_name"] ?>">
      </div>
      <div>
        メーカー: <input type="text" name="maker" value="<?= $record["maker"] ?>">
      </div>
      <div>
        サイズ: <input type="text" name="size" value="<?= $record["size"] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>

</body>

</html>