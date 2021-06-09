<?php
//設定関連の読み込み
include_once('../config.php');
//便利な関数の読み込み
include_once('../util.php');

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<?php include_once('../Views/common/head.php'); ?>
    <title>会員登録画面 / Twitterクローン</title>
    <meta name="description" content="会員登録画面です">
</head>

<body class=" signup text-center"> 
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