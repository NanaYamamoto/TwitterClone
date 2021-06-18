<?php
/////////////////////////////
//post controller
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


//tweetがある場合
$image_name = null;
if (isset($_POST['body'])) {
    if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image_name = uploadImage($user, $_FILES['image'], 'tweet'); //TODO 画像アップロード
    }

    $data = [
        'user_id' => $user['id'],
        'body' => $_POST['body'],
        'image_name' => $image_name
    ];

    if (createTweet($data)){
        //ホーム画面に遷移
        header('Location:' .HOME_URL. 'Controllers/home.php');
        exit;
    }    
}


//画面表示
$view_user = $user;

include_once('../Views/post.php');

