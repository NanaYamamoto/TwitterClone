<?php
/////////////////////////////
//home controller
//////////////////////////////

//設定を読み込み
include_once('../config.php');
//便利な関数を読み込み
include_once('../util.php');

//ログインしているか
$user = getUserSession();
if (!$user) {
    //ログインしていない場合
    header('Location:' . HOME_URL . 'Controllers/login.php');
    exit;
}

//画面表示
$view_user = $user;

//ツイート一覧
//TOTO: あとでDBから取得

include_once ('../Views/home.php');