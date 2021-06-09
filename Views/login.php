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
    <title>ログイン画面 / Twitterクローン</title>
    <meta name="description" content="ログイン画面です">
</head>

<body class="signup text-center"> 
    <main class="form-signup">
        <form action="" method="POST">
                <img src="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" class="logo-white">
                <h1>Twitterクローンにログイン</h1>
            
                <input type="text" class="form-control" name="mail" placeholder="メールアドレス" required autofocus>
            
                <input type="text" class="form-control" name="password" placeholder="パスワード" required>
                
                <input class="w-100 btn btn-lg" type="submit" name="login" value="ログイン">
            
                <p class="mt-3 mb-2"><a href="login.php">会員登録する</a></p>
                <p class="mt-2 mb-3 text-muted">&copy;2021</p>

        </form>
    </main>
</body>
</html>