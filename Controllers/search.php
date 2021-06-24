<?php
/////////////////////////////
//search controller
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

//検索結果を取得
$keyword = null;
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}

//画面表示(表示用の変数に入れる)
$view_user = $user;
$view_keyword = $keyword;
//ツイート一覧
$view_tweets = findTweets($user, $keyword);
include_once ('../Views/search.php');