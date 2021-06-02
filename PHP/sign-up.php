<?php
//URLディレクトリ設定
define('HOME_URL','/TwitterClone/');

    //入力漏れがない場合login.phpへredirect
    if(!empty($_POST["register"])){
        if(!empty($_POST["nickname"]) && !empty($_POST["username"]) && !empty($_POST["mail"]) && !empty($_POST["password"])){
            header("Location: login.php");
        };
    };
    

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/TwitterClone/Views/img/logo-twitterblue.svg">
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="/TwitterClone/Views/css/style.css" rel="stylesheet">

    <title>会員登録画面 / Twitterクローン</title>
    <meta name="description" content="会員登録画面です">
</head>

<body class="text-center"> 
    <main class="form-signup">
        <form action="" method="POST">
                <img src="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" class="logo-white">
                <h1>アカウントを作る</h1>

                <input type="text" class="form-control" name="nickname" placeholder="ニックネーム" maxlength="50" required autofocus>
                
                <input type="text" class="form-control" name="username" placeholder="ユーザー名、例)techis132" maxlength="50" required>
            
                <input type="text" class="form-control" name="mail" placeholder="メールアドレス" maxlength="254" required>
            
                <input type="text" class="form-control" name="password" placeholder="パスワード" minlength="4" maxlength="128" required>
                
                <input class="w-100 btn btn-lg" type="submit" name="register" value="登録する">
            
                <p class="mt-3 mb-2"><a href="login.php">ログインする</a></p>
                <p class="mt-2 mb-3 text-muted">&copy;2021</p>

        </form>
    </main>
</body>
</html>