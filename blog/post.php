<?php
include 'partials/headers.php';

// fetch post from database if id is set 

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id =$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}


?>

<section class="singlepost">
    <div class="container singlepost_container">
        <h2><?= $post['title'] ?></h2>
        <div class="post_author">

            <?php
            // fetch author from users table using author_id
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id= $author_id";
            $author_result =  mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
            <div class="post_author-avatar">
                <img src="./images/<?= $author['avatar'] ?>" alt="">
            </div>
            <div class="post_author-info">
                <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                <small>
                    <?= date("M d,Y - H:i", strtotime($post['date_time'])) ?>
                </small>
            </div>
        </div>
        <div class="singlepost_thumbnail">
            <img src="./images/<?= $post['thumbnail'] ?> " alt="">
        </div>
        <p>
            <?= $post['body'] ?>
        </p>


    </div>

</section>

<!-- =========================END OF single post=========================== -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_comment'])) {
    $commenter_name = $_POST['commenter_name'];
    $comment_text = $_POST['comment_text'];
    
    // Insert comment into database
    $insert_comment_query = "INSERT INTO comments (post_id, commenter_name, comment_text) VALUES ('$id', '$commenter_name', '$comment_text')";
    mysqli_query($connection, $insert_comment_query);
}

// Fetch comments for the current post
$comments_query = "SELECT * FROM comments WHERE post_id = $id";
$comments_result = mysqli_query($connection, $comments_query);

?>


<section class="comments_section">
    <h3>Comments</h3>
    <div class="comments">
        <?php while ($comment = mysqli_fetch_assoc($comments_result)) { ?>
            <div class="comment">
                <strong><?= $comment['commenter_name'] ?>:</strong>
                <p><?= $comment['comment_text'] ?></p>
                <small><?= $comment['created_at'] ?></small>
                <!-- Add delete button with a form -->
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment['user_id']) { ?>
                    <form action="" method="post" style="display: inline;">
                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                        <input type="submit" name="delete_comment" value="Delete">
                    </form>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="comment_form">
        <h4>Leave a Comment</h4>
        <form action="" method="post">
            <input type="text" name="commenter_name" placeholder="Your Name" required><br>
            <textarea name="comment_text" rows="4" placeholder="Your Comment" required></textarea><br>
            <input type="submit" name="submit_comment" value="Submit">
        </form>
    </div>
</section>

<?php
// Check if delete comment request is sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_comment'])) {
    $comment_id = $_POST['comment_id'];
    
    // Implement deletion of the comment from the database
    $delete_comment_query = "DELETE FROM comments WHERE id = $comment_id";
    mysqli_query($connection, $delete_comment_query);
    
    // Redirect back to the same page after deletion
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}
?>



<footer>
    <div class="footer_social">
        <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
        <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-square-facebook"></i></a>
        <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-square-instagram"></i></a>
        <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
        <a href="https://www.twitter.com/" target="_blank"><i class="fa-brands fa-square-x-twitter"></i></a>
    </div>
    <div class="container footer_container">
        <article>
            <h4>Categories</h4>
            <ul>
                <li><a href="">Art</a></li>
                <li><a href="">Wild Life</a></li>
                <li><a href="">Art</a></li>
                <li><a href="">Travel</a></li>
                <li><a href="">Music</a></li>
                <li><a href="">Science & Technology</a></li>
                <li><a href="">Food</a></li>
            </ul>
        </article>
        <article>
            <h4>Support</h4>
            <ul>
                <li><a href="">Online Support</a></li>
                <li><a href="">Call Numbers</a></li>
                <li><a href="">Emails</a></li>
                <li><a href="">Social Support</a></li>
                <li><a href="">Location</a></li>
            </ul>
        </article>
        <article>
            <h4>Blog</h4>
            <ul>
                <li><a href="">Safety</a></li>
                <li><a href="">Repair</a></li>
                <li><a href="">Recent</a></li>
                <li><a href="">Popular</a></li>
                <li><a href="">Categories</a></li>
            </ul>
        </article>
        <article>
            <h4>Permalinks</h4>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </article>
    </div>
    <div class="footer_copyright">
        <small>Copyright &copy;2024 CODE FLEXX</small>
    </div>
</footer>

<script src="js/main.js"></script>
</body>

</html>