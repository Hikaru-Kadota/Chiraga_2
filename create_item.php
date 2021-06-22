<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

if (
  !isset($_POST['item_name']) || $_POST['item_name'] == '' ||
  !isset($_POST['size']) || $_POST['size'] == '' ||
  !isset($_POST['maker']) || $_POST['maker'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
  $uploaded_file_name = $_FILES['image']['name']; //ファイル名を取得
  $temp_path = $_FILES['image']['tmp_name']; //tmpフォルダの場所
  $directory_path = 'upload/'; //アップロード先ォルダ(自分で決める)
  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;
  if (is_uploaded_file($temp_path)) {

    if (move_uploaded_file($temp_path, $filename_to_save)) {
      chmod($filename_to_save, 0644);
    } else {
      exit('ERROR:アップロードできませんでした');
    }
  } else {
    exit('ERROR:画像がありません');
  }
} else {
  exit('error:画像が送信されていません');
}

$item_name = $_POST['item_name'];
$size = $_POST['size'];
$maker = $_POST['maker'];
$owner_id = $_SESSION['id'];

$sql = 'INSERT INTO item_table(id, item_name, size, maker, image, owner_id, is_status, recuestUser_id, created_at, updated_at) VALUES(NULL, :item_name, :size, :maker, :image, :owner_id, 0, NULL, sysdate(), sysdate())';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
$stmt->bindValue(':size', $size, PDO::PARAM_STR);
$stmt->bindValue(':maker', $maker, PDO::PARAM_STR);
$stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
$stmt->bindValue(':owner_id', $owner_id, PDO::PARAM_INT);

$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:My_list.php");
  exit();
}
