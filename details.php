<?php 
session_start();

include_once('./db/db_config.php');

if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $query = "SELECT `job_title`, `job_description`, `job_salary`, `company`, `date_created` FROM `offers` WHERE `date_deleted` IS NULL AND `id` = ? LIMIT 1";
}else{
    $query = "SELECT `job_title`, `job_description`, `job_salary`, `company`, `date_created` FROM `offers` WHERE `approved` IS NOT NULL AND `date_deleted` IS NULL AND `id` = ? LIMIT 1";
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $offer_id = htmlspecialchars($_GET['id']);

    $mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param('i', $offer_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $offer = $result->fetch_assoc();

    $stmt->close();
    $mysqli->close();

    if(empty($offer)){
        header('Location: ./index.php');
        exit;
    }
}else{
    header('Location: ./index.php');
    exit; 
}

$mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

$related_offers_query = "SELECT `id`, `job_title`, `job_description`, `job_salary`, `company`, `date_created` FROM `offers` WHERE `approved` IS NOT NULL AND `date_deleted` IS NULL AND `id` NOT IN (?) ORDER BY `date_created` DESC LIMIT 3";

$stmt = $mysqli->prepare($related_offers_query);

$stmt->bind_param('i', $offer_id);
$stmt->execute();

$result = $stmt->get_result();

$related_offers = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$mysqli->close();

$now = date('Y-m-d H:i:s');

function posted_ago($now, $past){
    $origin = new DateTime($past);
    $target = new DateTime($now);

    $interval = $origin->diff($target);

    $years = $interval->format('%y');
    $months = $interval->format('%m');
    $days = $interval->format('%d');
    $hours = $interval->format('%h');
    $minutes = $interval->format('%i');

    if($years > 0){
        return ($years == 1) ? 'Posted one year ago.' : 'Posted ' . $years . ' years ago.';
    }else if($months > 0){
        return ($months == 1) ? 'Posted one month ago.' : 'Posted ' . $months . ' months ago.';
    }else if($days > 0){
        return ($days == 1) ? 'Posted one day ago.' : 'Posted ' . $days . ' days ago.';
    }else if($hours > 0){
        return ($hours == 1) ? 'Posted one hour ago.' : 'Posted ' . $hours . ' hours ago.';
    }else if($minutes > 0){
        return ($minutes == 1) ? 'Posted one minute ago.' : 'Posted ' . $minutes . ' minutes ago.';
    }else{
        return 'Posted just now.';
    }
}

ob_start();
?>
<div class="job-single">
    <main class="job-main">
        <div class="job-card">
            <div class="job-primary">
                <header class="job-header">
                    <h2 class="job-title"><a href="#"><?php echo $offer['job_title'] ?></a></h2>
                    <div class="job-meta">
                        <a class="meta-company" href="#"><?php echo $offer['company'] ?></a>
                        <span class="meta-date"><?php echo posted_ago($now, $offer['date_created']) ?></span>
                    </div>
                    <div class="job-details">
                        <span class="job-location">Salary: <?php echo $offer['job_salary'] ?>$</span>
                    </div>
                </header>

                <div class="job-body">
                    <?php echo $offer['job_description'] ?>
                </div>
            </div>
        </div>
    </main>
    <aside class="job-secondary">
        <div class="job-logo">
            <div class="job-logo-box">
                <img src="https://i.imgur.com/ZbILm3F.png" alt="">
            </div>
        </div>
        <a href="#" class="button button-wide">Apply now</a>
    </aside>
</div>
<?php if(!empty($related_offers)): ?>
<h2 class="section-heading">Other related jobs:</h2>
<ul class="jobs-listing">
    <?php foreach($related_offers as $offer): ?>
    <li class="job-card">
        <div class="job-primary">
            <h2 class="job-title"><a href="<?php echo './details.php?id=' . $offer['id'] ?>"><?php echo $offer['job_title'] ?></a></h2>
            <div class="job-meta">
                <a class="meta-company" href="#"><?php echo $offer['company'] ?></a>
                <span class="meta-date"><?php echo posted_ago($now, $offer['date_created']) ?></span>
            </div>
            <div class="job-details">
                <span class="job-location">Salary: <?php echo $offer['job_salary'] ?>$</span>
            </div>
        </div>
        <div class="job-logo">
            <div class="job-logo-box">
                <img src="https://i.imgur.com/ZbILm3F.png" alt="">
            </div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<?php
$page_content = ob_get_clean();

include_once('./common/header.php');
?>