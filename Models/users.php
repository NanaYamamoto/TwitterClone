<?php
////////////////////////
//ユーザーデータの処理
/////////////////////////

/**
 * ユーザーを作成
 * 
 *　@param array $data
 *  @return bool
 */

function createUser(array $data)
{
    $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続チェック
    if ($mysql->connect_errno){
        echo 'MySQLの接続に失敗しました。：' . $mysql->connect_error . '\n';
        exit;
    }

    //新規登録のSQLを作成
    $query = "INSERT INTO users (nickname, name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $mysql->prepare($query);
    //echo $mysql->error;

    //パスワードをハッシュ値に変更
    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //?の部分に値をセット
    //第一引数のs＝string　型を指定している
    $stmt->bind_param('ssss', $data['nickname'], $data['name'], $data['mail'], $data['password']);

    //処理を実行
    $response = $stmt->execute();
    if ($response === false){
        echo 'エラーメッセージ：' . $mysql->error . "\n";
    }

    //接続を解除
    $stmt->close();
    $mysql->close();

    return $response;
}