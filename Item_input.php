<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アイテム登録画面</title>
</head>

<body>
  <form action="create_item.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>アイテム登録画面</legend>
      <div>
        アイテム: <input type="text" name="item_name">
      </div>
      <div>
        サイズ: <input type="text" name="size">
      </div>
      <div>
        メーカー: <input type="text" name="maker">
      </div>
      <div>
        image: <input type="file" name="image" accept="image/*" capture="camera">
      </div>
      <div>
        <button>登録</button>
      </div>
    </fieldset>
  </form>

</body>

</html>