<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jobs</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<link rel="stylesheet" href="./css/master.css">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
	<?php if(isset($scripts)) echo $scripts ?>
</head>

<body>
	<?php include_once('navigation.php') ?>
	<div class="site-wrapper">
		<header class="site-header">
			<h1 class="site-title"><a href="index.php">Job Offers</a></h1>
		</header>

		<main id="main-content">
            <?php echo $page_content ?>
		</main>

		<?php include_once('footer.php') ?>
	</div>
</body>

</html>