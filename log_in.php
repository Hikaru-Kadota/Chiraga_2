   <!DOCTYPE html>
   <html lang="ja">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>ログイン画面</title>
       <link rel="stylesheet" href="style.css">
       <script type="text/javascript" src="contact.js"></script>
   </head>

   <body>
       <div>
           <h1>ホリマニア</h1>
       </div>
       <div>
           <h2>ログインフォーム</h2>
       </div>
       <form action="log_in_act.php" method="POST">
           <fieldset>
               <legend>ログイン画面</legend>
               <div>
                   ユーザーネーム<input type="text" name="user_name">
               </div>
               <div>
                   パスワード<input type="text" name="password">
               </div>
               <div>
                   <button>Login</button>
               </div>
               <a href="sigh_up.php">新規登録</a>
           </fieldset>
       </form>

   </body>

   </html>