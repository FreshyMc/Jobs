<?php
session_start();

include_once('./db/db_config.php');

if(!isset($_SESSION['username'])){
    header('Location: ./index.php');
    exit;
}

if(isset($_GET['approve']) && !empty($_GET['approve'])){
    $offer_id = htmlspecialchars($_GET['approve']);

    $approved = 1;

    $mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $query = "UPDATE `offers` SET `approved`= ? WHERE `id` = ? LIMIT 1";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param('ii', $approved, $offer_id);

    $stmt->execute();

    header('Location: ./admin.php?p=' . htmlspecialchars($_GET['p']));
    exit;
}

if(isset($_GET['reject']) && !empty($_GET['reject'])){
    $offer_id = htmlspecialchars($_GET['reject']);

    $mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $query = "UPDATE `offers` SET `approved`= NULL WHERE `id` = ? LIMIT 1";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param('i', $offer_id);

    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    header('Location: ./admin.php?p=' . htmlspecialchars($_GET['p']));
    exit;
}

if(isset($_GET['del']) && !empty($_GET['del'])){
    $offer_id = htmlspecialchars($_GET['del']);

    $mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $query = "UPDATE `offers` SET `date_deleted`= ? WHERE `id` = ?";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param('si', date('Y-m-d H:i:s'), $offer_id);

    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    header('Location: ./admin.php?p=' . htmlspecialchars($_GET['p']));
    exit;
}

$mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

$total_records_query = "SELECT COUNT(`id`) AS 'count' FROM `offers` WHERE `approved` IS NOT NULL AND `date_deleted` IS NULL";

$total_records_result = $mysqli->query($total_records_query);

$row = $total_records_result->fetch_assoc();

$total_records_count = $row['count'];

$offers_per_result = 3;

$links_count = 2;

$total_pages = ceil($total_records_count/$offers_per_result);

if(isset($_GET['p']) && !empty($_GET['p']) && is_numeric($_GET['p'])){
    $current_page = intval($_GET['p']);

    if($current_page <= 0){
        $current_page = 1;
    }else if($current_page > $total_pages){
        $current_page = $total_pages;
    }
}else{
    $current_page = 1;
}

$pagination = ($current_page - 1) * $offers_per_result;

$query = "SELECT `id`, `job_title`, `job_description`, `job_salary`, `company`, `approved`, `date_created` FROM `offers` WHERE `date_deleted` IS NULL ORDER BY `date_created` DESC LIMIT {$pagination}, {$offers_per_result}";

$result = $mysqli->query($query);

$mysqli->close();

$offers = $result->fetch_all(MYSQLI_ASSOC);

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
<ul class="jobs-listing">
    <?php foreach($offers as $offer): ?>
    <li class="job-card">
        <div class="job-primary">
            <h2 class="job-title"><a href="<?php echo './details.php?id=' . $offer['id'] ?>"><?php echo $offer['job_title'] ?></a></h2>
            <div class="job-meta">
                <a class="meta-company" href="#"><?php echo $offer['company'] ?></a>
                <span class="meta-date"><?php echo posted_ago($now, $offer['date_created']) ?></span>
            </div>
        </div>
        <div class="job-edit">
            <?php if($offer['approved'] == null): ?>
            <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?p=' . $current_page . '&approve=' . $offer['id']) ?>" onclick="return confirm('Are you sure to approve this offer?');">Approve</a>
            <?php else: ?>
            <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?p=' . $current_page . '&reject=' . $offer['id']) ?>" onclick="return confirm('Are you sure to reject this offer?');">Reject</a>
            <?php endif; ?>
            <a href="<?php echo './edit.php?id=' . $offer['id'] ?>">Edit</a>
            <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?p=' . $current_page . '&del=' . $offer['id']) ?>" onclick="return confirm('Are you sure to delete this offer?');">Delete</a>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
<div class="paginator">
    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?p=1' ?>" style="visibility: <?php echo ($current_page > 1) ? '' : 'hidden' ?>">First</a>
    <a class="m-spacing" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?p=' . ($current_page - 1) ?>" style="visibility: <?php echo ($current_page <= 1) ? 'hidden' : '' ?>">Prev</a>
    <ul>
    <?php for($i = ($current_page - $links_count); $i <= ($current_page + $links_count + 1); $i++): 
            if (($i > 0) && ($i <= $total_pages)):
        ?>
        <li><a class="<?php echo ($i == $current_page) ? 'active' : '' ?>" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?p=' . $i ?>"><?php echo $i ?></a></li>
    <?php
            endif; 
        endfor; ?>
    </ul>
    <a class="m-spacing" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?p=' . ($current_page + 1) ?>" style="visibility: <?php echo ($current_page >= $total_pages) ? 'hidden' : '' ?>">Next</a>
    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?p=' . $total_pages ?>" style="visibility: <?php echo ($current_page < $total_pages) ? '' : 'hidden' ?>">Last</a>
</div>
<?php
$page_content = ob_get_clean();

include_once('./common/header.php');
?>