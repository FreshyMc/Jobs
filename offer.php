<?php
session_start();

include_once('./db/db_config.php');

if(isset($_POST['create'])){
    $job_title = htmlspecialchars($_POST['title']);
    $job_description = htmlspecialchars($_POST['description']);
    $company = htmlspecialchars($_POST['company']);
    $job_salary = htmlspecialchars($_POST['salary']);

    if(empty($job_title) || empty($job_description) || empty($company)){
        $error_msg = 'All fields are required!';
    }else if(!is_numeric($job_salary) || $job_salary < 0){
        $negative = true;
        $error_msg = 'Salary must be a positive number!';
    }else{
        $mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $query = "INSERT INTO `offers`(`job_title`, `job_description`, `job_salary`, `company`, `date_created`) VALUES (?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('ssdss', $job_title, $job_description, $job_salary, $company, date('Y-m-d H:i:s'));
        $stmt->execute();
        $stmt->close();
        $mysqli->close();

        header('Location: ./success.php');
        exit;
    }
}

ob_start();
?>
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="form">
    <h2>Register job offer</h2>
    <div style="margin-bottom: 9px; padding: 15px; color: red; border: 1px solid red;display: <?php echo (isset($error_msg)) ? 'block' : 'none' ?>" id="error-box"><?php if(isset($error_msg)) echo $error_msg ?></div>
    <input class="<?php echo (isset($job_title) && empty($job_title)) ? 'error' : ''; ?>" type="text" name="title" placeholder="Job title" value="<?php echo (isset($job_title)) ? $job_title : ''; ?>">
    <textarea class="<?php echo (isset($job_description) && empty($job_description)) ? 'error' : ''; ?>" name="description" placeholder="Job description"><?php echo (isset($job_description)) ? $job_description : ''; ?></textarea>
    <input class="<?php echo (isset($company) && empty($company)) ? 'error' : ''; ?>" type="text" name="company" placeholder="Company name" value="<?php echo (isset($company)) ? $company : ''; ?>">
    <input class="<?php echo (isset($negative)) ? 'error' : ''; ?>" type="number" name="salary" step="0.01" min="0" placeholder="Salary" value="<?php echo (isset($job_salary)) ? $job_salary : ''; ?>">
    <input type="hidden" name="create" value="offer">
    <button type="submit">Submit offer</button>
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