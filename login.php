<?php
session_start();

include_once('./db/db_config.php');

if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    header('Location: ./admin.php');
    exit;
}

if(isset($_POST['login'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if(empty($email) || empty($password)){
        $error_msg = 'All fields are required!';
    }else{
        $mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $query = "SELECT `password`, `username` FROM `users` WHERE `email` = ? LIMIT 1";

        $stmt = $mysqli->prepare($query);
        
        $stmt->bind_param('s', $email);
        $stmt->execute();
        
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        if(!empty($row) && password_verify($password, $row['password'])){
            $_SESSION['username']=$row['username'];
            header('Location: ./admin.php');
            exit;
        }else{
            $error_msg = 'Email/Password don\'t match!';
        }
    }
}

ob_start();
?>
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="form">
    <h2>Log In</h2>
    <div style="margin-bottom: 9px; padding: 15px; color: red; border: 1px solid red;display: <?php echo (isset($error_msg)) ? 'block' : 'none' ?>" id="error-box"><?php if(isset($error_msg)) echo $error_msg ?></div>
    <input class="<?php echo (isset($email) && empty($email)) ? 'error' : ''; ?>" type="email" name="email" placeholder="Email" value="<?php echo (isset($email)) ? $email : ''; ?>">
    <input class="<?php echo (isset($password) && empty($password)) ? 'error' : ''; ?>" type="password" name="password" placeholder="Password" value="<?php echo (isset($password)) ? $password : ''; ?>">
    <input type="hidden" name="login" value="login_form">
    <button type="submit">Login</button>
</form>
<?php 
$page_content = ob_get_clean();

ob_start();
?>
<script src="./src/offer.js" defer></script>
<?php
$scripts = ob_get_clean();

include_once('./common/header.php');
?>