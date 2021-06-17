<?php
/*******************************************
----------便利な変数--------------------
***********************************************/
/*画像ファイル名から画像のURLを生成
*
* @param string $name 画像ファイル名
* @param string $type ユーザー画像かツイート画像
* @return string 
*/
function buildImagePath(string $name = null, string $type){
    if($type === 'user' && !isset($name)){
        return HOME_URL . 'Views/img/icon-default-user.svg';
    }
    return HOME_URL . 'Views/img_uploaded/' . $type .'/' .htmlspecialchars($name);
}


/*指定した日時からどれだけ経過したかを取得
*
* @param string $datatime 日時
* @return string 
*/
function convertToDayTimeAgo(string $datatime){
    
    $unix = strtotime($datatime);
    $now = time();
    $diff_sec = $now - $unix;

    if($diff_sec < 60){
        $time = $diff_sec;
        $unix = '秒前';
    }elseif($diff_sec < 3660){
        $time = $diff_sec / 60;
        $unix = '分前';
    }elseif($diff_sec < 86400){
        $time = $diff_sec / 3600;
        $unix = '時間前';
    }elseif($diff_sec < 2764800){
        $time = $diff_sec / 86400;
        $unix = '日前';
    }else{
        if(date('Y') != date('Y', $unix)){
            $time = date('Y年n月j日', $unix);
        }else{
            $time = date('n月j日', $unix);
        }
        return $time;
    }

    return(int)$time . $unix;
}

/**
 * ユーザー情報をセッションに保存
 * 
 * @param array $user
 * @return void
 */
 function saveUserSession(array $user)
 {
    //セッションをスタートしていない場合
    if (session_start() === PHP_SESSION_NONE) {
        //セッション開始
        session_start();
    }

    $_SESSION['USER'] = $user;
 }

 /**
  * ユーザー情報をセッションから削除
  *
  * @return void
  */
 function deleteUserSession()
 {
    //セッションをスタートしていない場合
    if (session_start() === PHP_SESSION_NONE) {
        //セッション開始
        session_start();
    }

    unset($_SESSION['USER']);
 }

 /**
  * セッションのユーザー情報を取得
  *
  * @return array / false
  */
  function getUserSession()
  {
    //セッションをスタートしていない場合
    if (session_start() === PHP_SESSION_NONE) {
        //セッション開始
        session_start();
    }

    if (!isset($_SESSION['USER'])) {
        //セッションにユーザー情報がない
        return false;
    }
    
    $user = $_SESSION['USER'];
    //画像のファイル名からファイルのURLを取得
    if (!isset($user['image_name'])) {
        $user['image_name'] = null;
    }
    $user['image_path'] = buildImagePath( $user['image_name'], 'user');

    return $user;
  }
?>