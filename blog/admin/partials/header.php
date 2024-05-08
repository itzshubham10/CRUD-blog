<?php

require '../partials/headers.php';

// check login satus

if(!isset($_SESSION['user-id'])){
    header('location: ' .ROOT_URL. 'signin.php');
    die();
}
?>





