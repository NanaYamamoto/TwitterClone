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
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続チェック
    if ($mysqli->connect_errno){
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_error . '\n';
        exit;
    }

    //新規登録のSQLを作成
    $query = "INSERT INTO users (nickname, name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    //echo $mysql->error;

    //パスワードをハッシュ値に変更
    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //?の部分に値をセット
    //第一引数のs＝string　型を指定している
    $stmt->bind_param('ssss', $data['nickname'], $data['name'], $data['mail'], $data['password']);

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

function findUserAndCheckPassword(string $email, string $password)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続チェック
    if ($mysqli->connect_errno){
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_error . '\n';
        exit;
    }

    //入力値をエスケープ
    $email = $mysqli->real_escape_string($email);

    //クエリを作成
    //外部からのリクエストは何が入っているのかわからないので、必ず、エスケープしたものを''で囲む。
    $query = 'SELECT * FROM users WHERE email = "'. $email .'" ';

    //SQL実行
    $result = $mysqli->query($query); 
    if (!$result){
        //MySQL接続中にエラー発生
        echo 'メッセージ：' . $mysqli->error . "\n";
        $mysqli->close();
        return false;
    }

    //ユーザー情報を取得
    $user = $result->fetch_array(MYSQLI_ASSOC);
    if (!$user){
        //ユーザー情報がない
        $mysqli->close();
        return false;
    }

    //パスワードチェック
    if (!password_verify($password, $user['password'])) {
        //パスワード不一致
        $mysqli->close();
        return false;
    }

    $mysqli->close();
    return $user;    

}