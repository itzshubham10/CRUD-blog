<?php

include '../partials/headers.php';

// fetch users from dtabase but not current user

$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id = $current_admin_id";

$users = mysqli_query($connection, $query);

?>






<section class="dashboard">

    <?php if (isset($_SESSION['add-user-success'])) :  // shows if add user was successful 
    ?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user-success'])) :  //shows if edit user was not  successful 
    ?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user'])) :  //shows if edit user was not successful 
    ?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user'])) :  //shows if edit user was not successful 
    ?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user-success'])) :  //shows if edit user was  successful 
    ?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']);
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
                        <a href="manage-user.php" class="active" <i class="fa-solid fa-users-line"></i>
                            <h5>Manage User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php" <i class="fa-solid fa-pen-to-square"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" <i class="fa-solid fa-list"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Users</h2>
            <?php if (mysqli_num_rows($users) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                            <tr>
                                <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Delete</a></td>
                                <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                            </tr>
                        <?php endwhile ?>

                    </tbody>
                </table>
            <?php else :  ?>
                <div class="alert_message error"><?= "No users Found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>



<?php

include '../partials/footers.php';
?>