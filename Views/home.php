<?php
//エラーを表示
ini_set('display_errors', 1);
//日本時間にする
date_default_timezone_set('Asia/Tokyo');
//URLディレクトリ設定
define('HOME_URL','/TwitterClone/');

/***************************************
------ツイート一覧--------
***************************************/
$view_tweets = [
    [
        'user_id' => 1,
        'user_name' => 'taro',
        'user_nickname' => '太郎',
        'user_image_name' => 'sample-person.jpg',
        'tweet_body' => '今プログラミングをしています。',
        'tweet_image'=>null,
        'tweet_created_at' => '2021-03-15 14:00:00',
        'like_id' => null,
        'like_count' => 0,
    ],
    [
        'user_id' => 2,
        'user_name' => 'kalai',
        'user_nickname' => 'Kalai ruban V',
        'user_image_name' => 'icon-kalai.jpg',
        'tweet_body' => 'spent night re-organizing my watch-collection(middle class ones)!',
        'tweet_image'=>'kalai-uploaded.jpg',
        'tweet_image'=>'kalai-uploaded.jpg',
        'tweet_created_at' => '2021-03-13 14:00:00',
        'like_id' => 1,
        'like_count' => 1,
    ]
];
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

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ホーム画面です">
    <link rel="icon" href="/TwitterClone/Views/img/logo-twitterblue.svg">
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="<?php echo HOME_URL; ?>/Views/css/style.css" rel="stylesheet">

    <title>ホーム画面 / Twitterクローン</title>
</head>
<body class="home">
    <div class="container">
        <div class="side">
            <div class="side-inner">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="home.php" class="nav-limk"><img src="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" alt="" class="icon"></a></li>
                    <li class="nav-item"><a href="home.php" class="nav-limk"><img src="<?php echo HOME_URL; ?>Views/img/icon-home.svg" alt=""></a></li>
                    <li class="nav-item"><a href="search.php" class="nav-limk"><img src="<?php echo HOME_URL; ?>Views/img/icon-search.svg" alt=""></a></li>
                    <li class="nav-item"><a href="notification.php" class="nav-limk"><img src="<?php echo HOME_URL; ?>Views/img/icon-notification.svg" alt=""></a></li>
                    <li class="nav-item"><a href="profile.php" class="nav-limk"><img src="<?php echo HOME_URL; ?>Views/img/icon-profile.svg" alt=""></a></li>
                    <li class="nav-item"><a href="post.php" class="nav-limk"><img src="<?php echo HOME_URL; ?>/Views/img/icon-post-tweet-twitterblue.svg" alt="" class="post-tweet"></a></li>
                    <li class="nav-item my-icon"><img src="<?php echo HOME_URL; ?>/Views/img_uploaded/user/sample-person.jpg" alt=""></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="main-header">
                <h1>ホーム</h1>
            </div>
            <div class="tweet-post">
                <div class="my-icon">
                    <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
                </div>
                <div class="input-area">
                    <form action="post.php" method="post" enctype="multipart/form-data">
                        <textarea name="body" placeholder="いまどうしてる？" maxlength="140"></textarea>
                        <div class="bottom-area">
                            <div class="mb-0">
                                <input type="file" name="image" class="form-control form-control-sm">
                            </div>
                            <button class="btn" type="submit">つぶやく</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="ditch"></div>



<!---------------------------------------
-------tweet一覧--------------------------
------------------------------------------>
<?php if(empty($view_tweets)):?>
    <p class="p-3">ツイートがまだありません</p>
<?php else:?>
            <div class="tweet-list">
            <?php foreach($view_tweets as $view_tweet):?>
                <div class="tweet">
                    <div class="user">
                        <a href="profile.php?user_id=<?php echo $view_tweet['user_id'];?>">
                            <img src="<?php echo buildImagePath($view_tweet['user_image_name'],'user');?>" alt="">
                        </a>
                    </div>
                    <div class="content">
                        <div class="name">
                            <a href="profile.php?user_id=<?php echo htmlspecialchars($view_tweet['user_id']);?>">
                                <span class="nickname"><?php echo htmlspecialchars($view_tweet['user_name']);?></span>
                                <span class="user-name">@<?php echo htmlspecialchars($view_tweet['user_nickname']);?>・<?php echo convertToDayTimeAgo($view_tweet['tweet_created_at']);?></span>
                            </a>
                        </div>
                        <p><?php echo htmlspecialchars($view_tweet['tweet_body']);?></p>
                        <?php if(isset($view_tweets['tweet_image'])):?>
                            <img src="<?php echo buildImagePath($view_tweet['tweet_image'],'tweet');?>" alt="" class="post-image">
                        <?php endif;?>
                        <div class="icon-list">
                            <div class="like">
                                <?php 
                                    if(isset($view_tweets['like_id'])){
                                        //いいね！がある場合ブルーのハートにする
                                        echo '<img src="HOME_URL"."/Views/img/logo-twitterblue.svg" alt="">';
                                    }else{
                                        echo '<img src="<?php echo HOME_URL; ?>/Views/img/icon-heart.svg" alt="">';
                                    }
                                ?>
                                
                            </div>
                            <div class="icon-count"><?php echo htmlspecialchars($view_tweet['like_count']);?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>

                
            </div>
<?php endif;?>
        </div>
    </div>
</body>
</html>