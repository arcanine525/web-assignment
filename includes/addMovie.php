<?php
    include "database.php";
	
	if(isset($_POST['movieId'])) {
		session_start();

		$movieId = mysqli_real_escape_string($con, $_POST['movieId']);
		$query = "SELECT * FROM `watchlist` WHERE `u_id` = ".$_SESSION['userId']." AND `m_id` = ".$movieId.";";
		$results = mysqli_query($con, $query);

		if(mysqli_num_rows($results) == 0) {
			$query = "INSERT INTO `watchlist`(`u_id`, `m_id`) VALUES (".$_SESSION['userId'].", ".$movieId.");";
			mysqli_query($con, $query);
			echo "true";
		}
		
		else
			echo "false";
	}