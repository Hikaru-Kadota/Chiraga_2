<?php
// var_dump($_POST);
// exit('ok');
session_start();
include('functions.php');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>会員登録フォーム</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="contact.js"></script>
</head>

<body>
    <div>
        <h1>ホリマニア</h1>
    </div>
    <div>
        <h2>会員登録フォーム</h2>
    </div>
    <div>
        <form action="sigh_up_check.php" method="POST" name="form" onsubmit="return validate()">
            <h1 class="contact-title">会員登録 内容入力</h1>
            <p>お客様情報をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
            <div>
                <div>
                    <label>名前<span>必須</span></label>
                    <input type="text" name="user_name" placeholder="例）山田太郎" value="">
                </div>
                <div>
                    <label>メールアドレス<span>必須</span></label>
                    <input type="text" name="mail" placeholder="例）kutsuo@example.com" value="">
                </div>
                <div>
                    <label>パスワード<span>必須</span></label>
                    <input type="text" name="password" placeholder="例）123456789" value="">
                </div>
                <div>
                    <label>住所<span>必須</span></label>
                    <input type="text" name="address" placeholder="例 ○県○市○区○○ ○丁目○-○-○○○" value="">
                </div>
                <div>
                    <label>電話番号<span>必須</span></label>
                    <input type="text" name="phone" placeholder="例）0000000000" value="">
                </div>
            </div>
            <button type="submit">確認画面へ</button>
            <a href="log_in.php">ログイン</a>
        </form>
    </div>
</body>

</html>