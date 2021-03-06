<?php
include "../includes/database-connection.php";

// This class will be call on in update_page.php to insert data into the table posts in millhouse database.
class PostsInsert {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertPosts() {

        // If title from post is set, run this code. 
        if (isset($_POST["title"])) {
            
            // Redefine variables from $_POST.
            // strip_tags to secure input fields from inserting harmful code to database.

            $image = $_FILES["image"];
            $image_text = strip_tags($_POST["text"]);
            $title = strip_tags($_POST["title"]);
            $user_id = $_SESSION["user_id"];
            // Set the correct timezone.
            date_default_timezone_set("Europe/Stockholm");
            $date = date('Y/m/d H:i');
            $id_category = $_POST["category_list"];

            // Define the value of the array. Point out the exact number to insert to database.
            foreach($id_category as $key => $value) {
                $id_category = $value;

            }

            // Change folder where uploaded images land.
            $temporary_location = $image["tmp_name"];
            $new_location = "../images/uploads/" . $image["name"];
            $upload_ok = move_uploaded_file($temporary_location, $new_location);

            // Insert variables to correct rows in table.
            if($upload_ok) {
                $statement = $this->pdo->prepare("INSERT INTO posts (image, content, title, date, created_by, id_category) VALUES (:image, :content, :title, :date, :created_by, :id_category)");
                $statement->execute(
                [
                    ":image" => $new_location,
                    ":content"  => $image_text,
                    ":created_by" => $user_id,
                    ":title" => $title,
                    ":date" => $date,
                    ":id_category" => $id_category
                ]
            ); 
            return $upload_ok;
            }
        }
    }
}

