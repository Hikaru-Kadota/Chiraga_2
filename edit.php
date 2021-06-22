 <?php
    // var_dump($_GET);
    // exit();
    session_start();
    include('functions.php');
    check_session_id();

    $id = $_GET['id'];
    // echo $id;
    // exit('ok');


    $pdo = connect_to_db();


    try {
        $pdo = new PDO('mysql:dbname=chiraga;charset=utf8;port=3306;host=localhost', 'root', '');
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
    $sql = 'SELECT * FROM users_table WHERE id=:id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();

    // exit('ok');

    $view = '';
    if ($status == false) {
        $error = $stmt->errorInfo();
        // exit('ErrorQuery:' . $error[2]);
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {
        $row = $stmt->fetch();
        // $row['sex'] = '男性' or '';

        // $row['item'] = 'seleed';
    }
    ?>
 <!DOCTYPE html>
 <html lang="ja">

 <head>
     <meta charset="UTF-8">
     <title>登録情報一覧</title>
     <link rel="stylesheet" href="style.css">
     <script type="text/javascript" src="contact.js"></script>
 </head>

 <body>
     <div>
         <h1>ホリマニア</h1>
     </div>
     <div>
         <h2>登録情報一覧</h2>
     </div>
     <div>
         <form action="update.php" method="POST" name="form" onsubmit="return validate()">
             <h1 class="contact-title">会員登録 内容入力</h1>
             <p>お客様情報をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
             <div>
                 <div>
                     <label>お名前</label>
                     <input type="text" name="user_name" placeholder="例）山田太郎" value="<?= $row['user_name'] ?>">
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
                     <input type="text" name="addres" placeholder="例 ○県○市○区○○ ○丁目○-○-○○○" value="">
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