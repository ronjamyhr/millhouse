<?php
session_start();
include "../includes/head-views.php";
include "../includes/header-views.php";
//include '../classes/Posts.php';
//include "../includes/fetch-single-post.php";
include "../includes/upload_comments.php";

//echo "Hej";

//var_dump($_SESSION["post_id"]);
//var_dump($_SESSION["id"]);


$single_post = new PostsFetch($pdo);
$one_post = $single_post->fetchSinglePost();

$delete= new PostsEdit($pdo);
$delete_post = $delete->deletePost();

$update = new PostsEdit($pdo);
$update_post = $update->updatePost();

$add_comment = new CommentsFetch($pdo);
$insert_comment = $add_comment->insertComments();
?>



    <main class="container">

        <section>

                <?php


        foreach($one_post as $post):?>

        <div class="col-12 row mb-4 border border-dark justify-content-between">
            <div class="col-4">
                <h2><?= $post["title"]; ?></h2>
                <p><?= $post["date"] . '<strong> Category: </strong>' . $post["category"] . '<strong> Wrote by: </strong>' . $post["username"]; ?></p>
                <p><?= $post["content"];  ?></p>
            </div>
            <div class="col-8">
                <img src="<?= $post["image"]; ?>" alt="Cool image.">
            </div>
            <div>
                <form action="post.php" method="POST">
                    <input type="submit" value="DELETE">
                    <input type="hidden" name="single_post_id_delete" value="<?= $post['id']; ?>">
                </form>


            </div>
        </div>
        <?php
        endforeach;
       // var_dump($_GET["id"]
        ?>

        <!-- If we are sending a file in a form we must supply the extra attribute
     'encytype="multipart/form-data"', otherwise the file will be sent as a
     string and not uploaded to the server, otherwise the form is similar to every other form -->
     <form action="post.php?id=<?= $post["id"]; ?>" method="POST" enctype="multipart/form-data" class="m-4 p-4">
        <label for="image">Image</label>
        <!-- Use 'type="file"' to automatically create a input-field for uploads -->
        <input type="file" name="image" id="image" src="../views/uploads/anka.jpg">
        <!-- Use a textarea for a bigger input-field, put an ID on the area for the
        wysiwyg-editor to initialize on -->
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $post["title"] ?>">

        <select name="category_checkbox[]" id="" required>
            <option value="">Choose category</option>
            <option value="1">Living</option>
            <option value="2">Sunglasses</option>
            <option value="3">Watches</option>
        </select>
       <textarea name="content" id="text_edit"><?= $post["content"] ?></textarea>
       <input type="hidden" name="single_post_id_update" value="<?= $post['id']; ?>">
       <input type="submit" value="Update">
    </form>
    </section>


            <div class="row mb-4 border border-dark justify-content-between">
              <div class="col-10">
                <h3>Comments</h3>
                <h4>Write your comment</h4>
                <form action="post.php?id=<?= $post["id"]; ?>" method="POST">
                  <label for="comments"></label>
                  <textarea name="content" rows="20" cols="100"></textarea>
                  <button type="submit" class="btn btn-dark">COMMENT ON POST</button>
                </form>

              </div>
            </div>

        </section>

    </main>

    <div class="row mb-4 border border-dark justify-content-between">
         <div class="col-10">
           <h2>COMMENTS</h2>
           <?php
           /*foreach(array_reverse($comments_for_specific_post) as $comment){
           echo "<h3>" . $comment["created_by"] . "</h3>" ;
           echo $comment["content"]; echo "<br>";?>

           <form action="post.php" method="POST">
               <input type="submit" value="DELETE COMMENTS">
               <input type="hidden" name="single_comment_id_delete" value="<?= $comment["id"]; ?>">
           </form>
           <?= "<b>" . $_SESSION["date_time"] . "</b>"; ?>

           <?= $comment["id"]; ?>


         <?php }*/?>

         </div>
       </div>



       <?php
       include "../includes/footer-views.php";

       ?>
       <!-- Link dependencies for the editor -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
  <script>
    /**
     * use the id of the textarea in the form to initialize this text-editor: #text
     */
    $(document).ready(function() {
      $('#text_edit').summernote();
    });
  </script>
