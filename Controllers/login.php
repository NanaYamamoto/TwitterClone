<?php
/////////////////////////////
//login controller
//////////////////////////////

//設定を読み込み
include_once('../config.php');
//便利な関数を読み込み
include_once('../util.php');
//モデル（users.php）の読み込み
include_once('../Models/users.php');

$try_login_result = null;
if (isset($_POST['mail']) && isset($_POST['password'])){
    //ログインチェック実行
    $user =  findUserAndCheckPassword($_POST['mail'], $_POST['password']);

    if ($user){
        //ログイン成功
        //ユーザー情報をセッションに保存
        saveUserSession($user);

        //ホーム画面へ遷移
        header('Location:' . HOME_URL . 'Controllers/home.php');
        exit;
    }else{
        //ログイン失敗
        $try_login_result = false;
    }
}


//画面表示
$view_try_login_result = $try_login_result;
include_once('../Views/login.php');
