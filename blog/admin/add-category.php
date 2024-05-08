<?php

include '../partials/headers.php';

// get back form data if invalid

$title =  $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-cagtegory-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
?>




<section class="form_section">
    <div class="container form_section_container">
        <h2>Add Category</h2>
        <?php if (isset($_SESSION['add-category'])) : ?>
            <div class="alert_message error">
                <p>
                    <?= $_SESSION['add-catgegory'];
                    unset($_SESSION['add-category']) ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="post">
            <input type="text" value="<?=$title ?>" name="title" placeholder="Title">
            <textarea rows="4" value="<?=$description ?>" name="description" placeholder="Description"></textarea>
            <button type="submit" name="submit" class="btn" submit">Add Category</button>
        </form>
    </div>
</section>


<?php
include '../partials/footers.php'
?>