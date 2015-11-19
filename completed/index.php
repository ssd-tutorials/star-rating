<?php
require_once('classes/Helper.php');

try {

	// new pdo connection
	$objDb = new PDO('mysql:host=localhost;dbname=books', 'root', 'password');
	$objDb->exec("SET CHARACTER SET utf8");
	
	// get all records
	$sql = "SELECT *
			FROM `books`
			ORDER BY `title` ASC";
	$statement = $objDb->query($sql);
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch(Exception $e) {

	echo 'There was a problem with the database';
	
}

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Star rating</title>
	<meta name="description" content="Star rating" />
	<meta name="keywords" content="Star rating" />
	<link href="/css/core.css" rel="stylesheet" type="text/css" />
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

<section id="wrapper">
	
	<?php 
		if (!empty($results)) {
		
			foreach($results as $row) { 
				$class = Helper::id2Name($row['rating']);		
				$class = !empty($class) ? ' '.$class : null;
		?>
			
			<article class="book">
			
				<h1><?php echo $row['title']; ?></h1>
				
				<p>
					Category: <?php echo $row['category']; ?> | 
					Author: <?php echo $row['author']; ?> | 
					Price: &pound;<?php echo $row['price']; ?>
				</p>
				
				<p>Rating based on <span id="votes_<?php echo $row['id']; ?>"><?php echo $row['votes']; ?></span> votes:</p>
				
					
				<ul class="stars<?php echo $class; ?>" id="item_<?php echo $row['id']; ?>">
					<li><a href="#" rel="star-1"> </a></li>
					<li><a href="#" rel="star-2"> </a></li>
					<li><a href="#" rel="star-3"> </a></li>
					<li><a href="#" rel="star-4"> </a></li>
					<li><a href="#" rel="star-5"> </a></li>
				</ul>
				
				
			</article>
			
		<?php 
			}
		} 
		?>

</section>

<script src="/js/jquery-1.6.2.min.js"></script>
<script src="/js/core.js"></script>
</body>
</html>