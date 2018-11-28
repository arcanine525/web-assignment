<?php
session_start();

$_SESSION['logged-in'] = (!isset($_SESSION['logged-in'])) ? true : $_SESSION['logged-in'];
$_SESSION['loginFailed'] = (!isset($_SESSION['loginFailed'])) ? false : $_SESSION['loginFailed'];
$_SESSION['username'] = (!isset($_SESSION['username'])) ? '' : $_SESSION['username'];
$_SESSION['password'] = (!isset($_SESSION['password'])) ? '' : $_SESSION['password'];
$_SESSION['userId'] = (!isset($_SESSION['userId'])) ? 0 : $_SESSION['userId'];
$_SESSION['joinDate'] = (!isset($_SESSION['joinDate'])) ? 0 : $_SESSION['joinDate'];
$_SESSION['moderator'] = (!isset($_SESSION['moderator'])) ? 0 : $_SESSION['moderator'];

if ($_SESSION['username'] === '')
    $_SESSION['logged-in'] = false;

if (!isset($_GET['searchQuery']))
    header("Location: \movies-library\index.php");

include "../includes/header.php";
include "../includes/database.php";

$searchQuery = $_GET['searchQuery'];
$searchType = (!isset($_GET['searchType']) == true) ? "movie" : $_GET['searchType'];
$searchQuery = mysqli_real_escape_string($con, $searchQuery);
$filterCategory = !isset($_GET['filterCategory']) == true ? "" : $_GET['filterCategory'];
$resultPage = !isset($_GET['resultPage']) == true ? 0 : $_GET['resultPage'];

$u_id = !isset($_POST['u_id']) == true ? "" : $_POST['u_id'];
?>
    <main class="container mt-5 mb-5">
        <?php
        $cate = "";
        if ($searchQuery != "") {
            //$searchQuery  = $searchQuery . "%";
            $query = "SELECT * FROM `movie` WHERE `m_title` LIKE '$searchQuery%' ORDER BY `m_rdate` DESC LIMIT " . ($resultPage * 6) . ", 6;";
            //echo $query;
            $rquery = "SELECT * FROM `movie` WHERE `m_title` LIKE '$searchQuery%' ORDER BY `m_rdate` DESC;";
        } else {
            if ($filterCategory == "") {
                $query = "SELECT * FROM `movie` ORDER BY `m_rdate` DESC LIMIT " . ($resultPage * 6) . ", 6;";
                //echo $query;
                $rquery = "SELECT * FROM `movie` ORDER BY `m_rdate` DESC;";
            } else {
                $query = "SELECT * FROM `movie` NATURAL JOIN `mgenre` NATURAL JOIN `genre` WHERE `g_title` LIKE '%$filterCategory%' ORDER BY `m_rdate` DESC LIMIT " . ($resultPage * 6) . ", 6;";
                //echo $query;
                $rquery = "SELECT * FROM `movie` NATURAL JOIN `mgenre` NATURAL JOIN `genre` WHERE `g_title` LIKE '%$filterCategory%' ORDER BY `m_rdate` DESC;";
            }
        }


        $results = mysqli_query($con, $query);
        $rows = mysqli_num_rows(mysqli_query($con, $rquery));
        $pages = ceil($rows / 6);
        $movies = mysqli_fetch_all($results, MYSQLI_ASSOC);

        $output = "<div class=\"row mb-5\">";
        $iter = 0;

        foreach ($movies as $movie) {
            $iter++;
            $img_url = 'http://image.tmdb.org/t/p/w500' . $movie["m_pic"] . "pg";
            $movie['m_des'] = strlen($movie['m_des']) > 50 ? substr($movie["m_des"], 0, 50) . "..." : $movie["m_des"];
            if ($iter == 4) $output .= "</div><div class=\"row\">";
            $output .= "
			<div class=\"col\">
				<div class=\"card\" style=\"width: 18rem;\">
					<img class=\"card-img-top\" style=\"width: 18rem;\" src=\"${img_url}\" alt=\"${movie["m_title"]} image\">
					<div class=\"card-body\">
						<h5 class=\"card-title\">${movie["m_title"]} - (" . date('Y', strtotime($movie["m_rdate"])) . ")</h5>
						<p class=\"card-text\">${movie["m_des"]}</p>
						<a href=\"\movies-library\pages\movie.php?movie=${movie["m_id"]}\" class=\"btn btn-primary\">Details</a>
					</div>
				</div>
			</div>
		";
        }
        $output .= '</div>';

        echo $output; ?>

        <?php if ($pages > 1): ?>
            <nav aria-label="Movie pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($resultPage == 0) echo "disabled" ?>">
                        <a class="page-link"
                           href="<?php echo "\movies-library\pages\search.php?searchQuery=$searchQuery&filterCategory=$filterCategory&resultPage=" . ($resultPage - 1); ?>"
                           aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for ($i = 0; $i < $pages; $i++): ?>
                        <li class="page-item <?php if ($i == $resultPage) echo "active" ?>"><a class="page-link"
                                                                                               href="<?php echo "\movies-library\pages\search.php?searchQuery=$searchQuery&filterCategory=$filterCategory&resultPage=$i"; ?>"><?php echo $i + 1; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if ($resultPage + 1 == $pages) echo "disabled" ?>">
                        <a class="page-link"
                           href="<?php echo "\movies-library\pages\search.php?searchQuery=$searchQuery&filterCategory=$filterCategory&resultPage=" . ($resultPage + 1); ?>"
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
                <hr>
            </nav>
        <?php endif; ?>
    </main>
<?php
include "../includes/footer.php";
?>