<?php
	require_once "database.php";

	$query = 'SELECT * FROM `movie` ORDER BY `m_rdate` DESC LIMIT 6;';
	$results = mysqli_query($con, $query);
	$movies = mysqli_fetch_all($results, MYSQLI_ASSOC);

	$output = "<div class=\"row mb-5\">";
	$iter = 0;

	foreach($movies as $movie) {
		$iter++;
        $img_url = 'http://image.tmdb.org/t/p/w500'.$movie["m_pic"]."pg";
        $movie['m_des'] = strlen($movie['m_des']) > 50 ? substr($movie["m_des"],0,50)."..." : $movie["m_des"];
	if($iter == 4) $output .= "</div><div class=\"row\">";
		$output .= "
			<div class=\"col\">
				<div class=\"card\" style=\"width: 18rem;\">
					<img class=\"card-img-top\" style=\"width: 18rem;\" src=\"${img_url}\" alt=\"${movie["m_title"]} image\">
					<div class=\"card-body\">
						<h5 class=\"card-title\">${movie["m_title"]} - (".date('Y', strtotime($movie["m_rdate"])).")</h5>
						<p class=\"card-text\">${movie["m_des"]}</p>
						<a href=\"\movies-library\pages\movie.php?movie=${movie["m_id"]}\" class=\"btn btn-primary\">Details</a>
					</div>
				</div>
			</div>
		";
	}
	$output .= '</div>';

	echo $output;