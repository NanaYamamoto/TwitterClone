<?php
////////////////////////
//tweet投稿データの処理
/////////////////////////

/**
 * ツイート作成
 * 
 * @param array $data
 * @return bool
 */
function createTweet(array $data)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続チェック
    if ($mysqli->connect_errno){
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_error . '\n';
        exit;
    }

    //新規登録のSQLを作成
    $query = "INSERT INTO tweets (user_id, body, image_name) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    //?の部分に値をセット
    //i=int, s=string
    $stmt->bind_param('iss', $data['user_id'],$data['body'], $data['image_name']);

    //SQL実行
    $response = $stmt->execute();
    if ($response === false){
        echo 'エラーメッセージ：' . $mysqli->error . "\n";
    }

    //接続を解除
    $stmt->close();
    $mysqli->close();

    return $response;
}