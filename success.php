<?php 
session_start();

ob_start();
?>
<main class="success-dialog">
    <span class="success">&check;</span>
    <h2>Your job offer was submitted successfully.</h2>
    <h2>Wait until our staff will aprove it and finally publish it!</h2>
    <a href="./index.php" class="action-link">Go home page</a>
</main>
<?php 
$page_content = ob_get_clean();

include_once('./common/header.php');
?>