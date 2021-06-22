<?php
// フォームのボタンが押されたら
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを各変数に格納
    $user_name = $_POST["user_name"];
    $mail = $_POST["mail"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
}

// 送信ボタンが押されたら
if (isset($_POST["submit"])) {
    // 送信ボタンが押された時に動作する処理をここに記述する

    // 日本語をメールで送る場合のおまじない
    mb_language("ja");
    mb_internal_encoding("UTF-8");

    //mb_send_mail("kanda.it.school.trial@gmail.com", "メール送信テスト", "メール本文");

    // 件名を変数subjectに格納
    $subject = "［自動送信］お問い合わせ内容の確認";

    // メール本文を変数bodyに格納
    $body = <<< EOM
{$user_name}　様

お問い合わせありがとうございます。
以下のお問い合わせ内容を、メールにて確認させていただきました。

===================================================
【 お名前 】 
{$user_name}

【 メールアドレス 】 
{$email}

【 住所 】 
{$address}

【 電話番号 】 
{$phone}

===================================================

内容を確認のうえ、回答させて頂きます。
しばらくお待ちください。
EOM;

    // 送信元のメールアドレスを変数fromEmailに格納
    $fromEmail = "contact@dream-php-seminar.com";

    // 送信元の名前を変数fromNameに格納
    $fromName = "会員登録テスト";

    // ヘッダ情報を変数headerに格納する		
    $header = "From: " . mb_encode_mimeheader($fromName) . "<{$fromEmail}>";

    // メール送信を行う
    mb_send_mail($email, $subject, $body, $header);

    // サンクスページに画面遷移させる
    // header("Location: thanks.php");
    // exit;
}
?>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>会員登録フォーム</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <h1>ホリマニア</h1>
    </div>
    <div>
        <h2>会員登録フォーム</h2>
    </div>
    <div>
        <form action="txt_create.php" method="POST">
            <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
            <input type="hidden" name="mail" value="<?php echo $mail; ?>">
            <input type="hidden" name="password" value="<?php echo $password; ?>">
            <input type="hidden" name="address" value="<?php echo $address; ?>">
            <input type="hidden" name="phone" value="<?php echo $phone; ?>">
            <h1 class="contact-title">会員登録 内容確認</h1>
            <p>お客様情報はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
                <div>
                    <label>お名前</label>
                    <p><?php echo $user_name; ?></p>
                </div>
                <div>
                    <label>メールアドレス</label>
                    <p><?php echo $mail; ?></p>
                </div>
                <div>
                    <label>パスワード</label>
                    <p><?php echo $password; ?></p>
                </div>
                <div>
                    <label>住所</label>
                    <p><?php echo $addres; ?></p>
                </div>
                <div>
                    <label>電話番号</label>
                    <p><?php echo $phone; ?></p>
                </div>
            </div>
            <input type="button" value="内容を修正する" onclick="history.back(-1)">
            <button type="submit" name="submit">送信する</button>
        </form>
    </div>
</body>

</html>