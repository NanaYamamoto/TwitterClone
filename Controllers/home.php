<?php
/////////////////////////////
//home controller
//////////////////////////////

//設定を読み込み
include_once('../config.php');
//便利な関数を読み込み
include_once('../util.php');
//Modelの読み込み
include_once('../Models/tweets.php');

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
$view_tweets = findTweets($user);

include_once ('../Views/home.php');