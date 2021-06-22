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

$item_name = $_POST["item_name"];
$size = $_POST["size"];
$maker = $_POST["maker"];
$id = $_POST["id"];

$sql = "UPDATE item_table SET item_name=:item_name, size=:size, maker=:maker, updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
$stmt->bindValue(':size', $size, PDO::PARAM_STR);
$stmt->bindValue(':maker', $maker, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:My_list.php");
  exit();
}
