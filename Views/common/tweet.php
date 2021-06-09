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
                        <?php if(isset($view_tweet['tweet_image'])):?>
                            <img src="<?php echo buildImagePath($view_tweet['tweet_image'],'tweet');?>" alt="" class="post-image">
                        <?php endif;?>
                        <div class="icon-list">
                            <div class="like js-like" data-like-id="<?php echo $view_tweet['like_id']; ?>">
                                <?php 
                                    if(isset($view_tweet['like_id'])){
                                        //いいね！がある場合ブルーのハートにする
                                        echo '<img src="'.HOME_URL.'Views/img/icon-heart-twitterblue.svg" alt="">';
                                        
                                    }else{
                                        echo '<img src="'.HOME_URL.'Views/img/icon-heart.svg" alt="">';
    
                                    }
                                ?>
                                
                            </div>
                            <div class="icon-count js-like-count"><?php echo htmlspecialchars($view_tweet['like_count']);?></div>
                        </div>
                    </div>
                </div>