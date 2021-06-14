<?php
///////////////////////////
///sign-up controller
//////////////////////////

//設定を読み込み
include_once('../config.php');

include_once('../Models/users.php');

//ユーザー作成
if (isset($_POST['nickname']) && isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['password']) ){
    $data = [
        'nickname' => $_POST['nickname'],
        'name' => $_POST['name'],
        'mail' => $_POST['mail'],
        'password' => $_POST['password']
    ];
    if(createUser($data)){
        //ログイン画面に遷移
        header('Location:' . HOME_URL . 'Controllers/login.php');
        exit;
    }
}

//画面表示
include_once ('../Views/sign-up.php');