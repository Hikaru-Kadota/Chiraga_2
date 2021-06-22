<?php
session_start();
include('functions.php');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>ホリマニア</h1>
    <form action="sigh_up.php" method="POST">
        <fieldset>
            <div>
                <button>sign_up</button>
            </div>
        </fieldset>
    </form>
    <form action="log_in.php" method="POST">
        <fieldset>
            <div>
                <button>log_in</button>
            </div>
        </fieldset>
    </form>
</body>

</html>