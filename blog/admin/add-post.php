<?php

include '../partials/headers.php';

// fetch categories  from database

$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);


// gset back form data if form was ivalid

$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

?>

<section class="form_section">
    <div class="container form_section_container">
        <h2>Add Post</h2>
        <?php if (isset($_SESSION['add-post'])) : ?>
            <div class="alert_message success">
                <p>
                    <?= $_SESSION['add-post'] ;
                    unset($_SESSION['add-post']);
                    ?>

                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>

            </select>

            <textarea rows="6" name="body" placeholder="Body"></textarea>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <div class="form_control inline">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                    <label for="is_featured">Featured</label>
                </div>
            <?php endif ?>
            <div class="form_control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn" ">Add Post</button>
            </form>
        </div>
    </section>


    <?php

    include '../partials/footers.php';
    ?>