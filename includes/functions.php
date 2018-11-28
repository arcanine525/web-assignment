<?php

	function hasMovie($con, $movieId) {
		$movieId = mysqli_real_escape_string($con, $movieId);
		$query = "SELECT * FROM `watchlist` WHERE `u_id` = ".$_SESSION['userId']." AND `m_id` = ".$movieId.";";
		$results = mysqli_query($con, $query);

		if(mysqli_num_rows($results) == 1)
			return true;
		else
			return false;
	}

	function usernameTaken($con, $username) {
		$username = mysqli_real_escape_string($con, htmlspecialchars($username));
		$query = "SELECT `u_id` FROM `user` WHERE `u_name` = '$username';";
		$results = mysqli_query($con, $query);

		if(mysqli_num_rows($results) == 1)
			return true;
		else
			return false;
	}