<?php
//設定関連の読み込み
include_once('../config.php');
//便利な関数の読み込み
include_once('../util.php');

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
?>
?>

<!DOCTYPE html>
<html lang="ja">

    <?php include_once('../Views/common/head.php'); ?>

    <title>検索画面 / Twitterクローン</title>
    <meta name="description" content="検索画面です">
</head>

<body class="home search text-center">
    <div class="container">
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main">
            <div class="main-header">
                <h1>検索</h1>
            </div>

            <form action="" method="get">
                <div class="search-area">
                    <input type="text" class="form-control" name="keyward" id="" placeholder="キーワード検索" required>
                    <button type="submit" class="btn">検索</button>
                </div>
            </form>

            <div class="ditch"></div>

            <?php if(empty($view_tweets)):?>
                <p class="p-3">該当するツイートが見つかりませんでした</p>
            <?php else:?>
                        <div class="tweet-list">
                        <?php foreach($view_tweets as $view_tweet):?>
                            <?php include('../Views/common/tweet.php'); ?>
                        <?php endforeach;?>

                            
                        </div>
            <?php endif;?>

        </div>
    </div>

    <?php include_once('../Views/common/foot.php')?>

</body>
</html>
