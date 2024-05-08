<?php

include '../partials/headers.php';

// fetch categories from database

$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);
?>






<section class="dashboard">


    <?php if (isset($_SESSION['add-category-success'])) :  // shows if add category was successful 
    ?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>
            </p>
        </div>

    <?php elseif (isset($_SESSION['add-category'])) :  // shows if add category was not successful 
    ?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-category'])) :  // shows if edit category was not successful 
    ?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-category-success'])) :  // shows if edit category was  successful 
    ?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-category-success'])) :  // shows if delete category was  successful 
    ?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
                ?>
            </p>
        </div>
    <?php endif ?>

    <div class="dashboard dashboard_container">
        <button id="show_sidebar" class="sidebar_toggle"><i class="fa-solid fa-chevron-right"></i></button>
        <button id="hide_sidebar" class="sidebar_toggle"><i class="fa-solid fa-chevron-left"></i></button>


        <aside>
            <ul>
                <li>
                    <a href="add-post.php" <i class="fa-solid fa-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php" <i class="fa-solid fa-address-card"></i>
                        <h5> Manage Posts</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add-user.php" <i class="fa-solid fa-user-plus"></i>
                            <h5>Add Users</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-user.php" <i class="fa-solid fa-users-line"></i>
                            <h5>Manage User</h5>
                        </a>
                        </liphp <li>
                        <a href="add-category.php" <i class="fa-solid fa-pen-to-square"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="active" <i class="fa-solid fa-list"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if (mysqli_num_rows($categories) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($category = mysqli_fetch_assoc($categories)) : ?>

                            <tr>
                                <td> <?= $category['title'] ?> </td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert_message error"><?= "No categories found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>


<?php

include '../partials/footers.php';
?>