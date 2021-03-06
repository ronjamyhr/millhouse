<div class="row blog_posts mb-5 justify-content-between">
    <div class="col-12 mb-3 col-md-6 blog_post_content">
        <a class="blog_title_link" href="post.php?id=<?= $post["id"]; ?>"><h2 class="font_h2">
        <?= $post["title"]; ?></h2></a>
        <p><i class="fas fa-clock" aria-label="time icon"></i> <?= $post["date"]?>
        - <a class="blog_post_link"  href="feed.php?category=<?=$post["category"];?>">
        <?=$post["category"];?></a></p>
        <div class="blog_posts_content_text">
            <?php
            if(strlen($post["content"]) > 300){
                $blog_posts_content_text = text_shorten($text = $post["content"]);
                echo $blog_posts_content_text;?>
                <a class="blog_post_link" href="post.php?id=<?= $post["id"]; ?>#comments"><p>Read more</p></a>
            <?php
            }else{
            ?>
                <p><?= $post["content"];?></p>
                <a class="blog_post_link" href="post.php?id=<?= $post["id"]; ?>"><p>Go to post</p></a>
                <?php
            }
            ?>
        </div> <!-- closing blog_posts_content_text-->
        <div class="row">
            <div class="col-6 col-md-3 d-flex align-self-center justify-content-center pt-2 inline_form_post">         
                <?php 
                foreach($comments_amount_for_specific_post as $comment):
                            
                    if($comment["id"] === $post["id"]){?>
                        <p><?=$comment["totalcomment"];?> comment (s)</p>
                        <?php   
                    }
                endforeach;?>
            </div>
            <div class="col-6 col-md-2 d-flex align-self-center inline_form_post">
                <a href="post.php?id=<?= $post["id"]; ?>#comments"><button class="general_button">Comment</button></a>
            </div>
        </div>
    </div> <!-- closing col-->

    <div class="feed_image_frame_blogpost col-12 col-md-5 p-0">
        <img src="<?= $post["image"]; ?>" alt="<?= $post["title"]; ?>">
    </div>
</div> <!-- closing row-->