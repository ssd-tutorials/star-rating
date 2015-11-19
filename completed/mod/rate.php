<?php
$id = $_GET['id'];
$class = $_GET['class'];

if (!empty($id) && !empty($class)) {
	
	require_once('../classes/Helper.php');
	$vote = Helper::name2Id($class);
	
	if (!empty($vote)) {
		
		try {

			// new pdo connection
			$objDb = new PDO('mysql:host=localhost;dbname=books', 'root', 'password');
			$objDb->exec("SET CHARACTER SET utf8");
			
			// get the record
			$sql = "SELECT *
					FROM `books`
					WHERE `id` = ?";
			$statement = $objDb->prepare($sql);
			$statement->execute(array($id));
			$result = $statement->fetch(PDO::FETCH_ASSOC);
		
		} catch(Exception $e) {
		
			echo 'There was a problem with the database';
			
		}
		
		if (!empty($result)) {
			
			$ratings = $result['ratings'] + $vote;
			$votes = $result['votes'] + 1;
			$rating = round(($ratings / $votes), 0);
		
			// update the record
			$sql = "UPDATE `books` 
					SET `rating` = ?, 
					`ratings` = ?, 
					`votes` = ?
					WHERE `id` = ?";
			$statement = $objDb->prepare($sql);
			$statement->execute(array(
				$rating,
				$ratings,
				$votes,
				$id
			));
			
			$new_class = Helper::id2Name($rating);
			
			
			$container = '<div class="stars '.$new_class.'" id="item_'.$id.'"> </div>';
			
			echo json_encode(array('error' => false, 'container' => $container, 'votes' => $votes));
			
		} else {
			echo json_encode(array('error' => true));
		}
	
	} else {
		echo json_encode(array('error' => true));
	}
	
} else {
	echo json_encode(array('error' => true));
}