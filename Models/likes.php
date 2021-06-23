<?php
/////////////////////////////////////////
//いいね！データの処理
////////////////////////////////////////

/**
 * いいね！を作成
 * 
 *　@param array $data
 *  @return int/false
 */
function createLike(array $data) 
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続チェック
    if ($mysqli->connect_errno){
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_error . '\n';
        exit;
    }

    //新規登録のSQLを作成
    $query = "INSERT INTO likes (user_id, tweet_id) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);
    
    //プレースホルダーに値をセット
    $stmt->bind_param('ii', $data['user_id'], $data['tweet_id']);
    
    //SQL実行
    if ($stmt->execute()){
        //結果をIDで返却
        $response = $mysqli->insert_id;
    }else {
        //結果を失敗で返却
        $response = false;
        echo 'エラーメッセージ：' . $mysqli->error . "\n";
    }

    //接続を解除
    $stmt->close();
    $mysqli->close();

    return $response;
}

/**
 * いいね！を削除
 * 
 *　@param array $data
 *  @return bool
 */
function deleteLike(array $data) 
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続チェック
    if ($mysqli->connect_errno){
        echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_error . '\n';
        exit;
    }

    //更新のSQLを作成
    $query = 'UPDATE likes SET status ="deleted" WHERE id = ? AND user_id = ?';
    $stmt = $mysqli->prepare($query);

    //プレースホルダーに値をセット
    $stmt->bind_param('ii', $data['like_id'], $data['user_id']);

    //SQLを実行
    $response = $stmt->execute();
    if ($response === false) {
        echo 'エラーメッセージ:' .$mysqli->error. '\n';
    }

    //接続を閉じる
    $stmt->close();
    $mysqli->close();

    return $response;
}