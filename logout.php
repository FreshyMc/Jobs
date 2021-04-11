<?php 
session_start();

if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    unset($_SESSION['username']);
    session_destroy();
}

header('Location: ./index.php');
exit;
?>