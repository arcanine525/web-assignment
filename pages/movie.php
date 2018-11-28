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

if (!isset($_GET['movie']))
    header("Location: \movies-library\index.php");

include "../includes/header.php";
require "../includes/database.php";


$movieId = $_GET['movie'];
$query = 'SELECT * FROM `movie` WHERE `m_id` = ' . $movieId . ';';
$results = mysqli_query($con, $query);
$movie = mysqli_fetch_assoc($results);
//echo $movie["m_title"];
$img_url = 'http://image.tmdb.org/t/p/w500' . $movie["m_pic"] . "pg";
//echo  $img_url;
//	$query = 'SELECT COUNT(`userId`) AS `members` FROM `libraries` WHERE `movieId` = '.$movieId.';';
//	$rMems = mysqli_query($con, $query);
//	$members = mysqli_fetch_assoc($rMems);

$g_query = 'SELECT g_title, m_title FROM movie NATURAL JOIN mgenre NATURAL JOIN genre WHERE m_id=' . $movieId . ';';
$g_results = mysqli_query($con, $g_query);
$genres = mysqli_fetch_all($g_results, MYSQLI_ASSOC);


function formatTime($minutes)
{
    if ($minutes == 0) return "Unknown";
    else {
        return intval(($minutes / 60)) . "h " . intval($minutes % 60) . "m";
    }
}
?>
    <main class="container mt-5 mb-5">
        <div class="card mt-5 mb-5">
            <div class="card-header">
                <?php if ($_SESSION['logged-in'] == true): ?>
                    <div class="row">
                        <div class="col-10">
                            <h2 class="text-left"><?php echo "${movie["m_title"]} - (" . date('Y', strtotime($movie["m_rdate"])) . ")"; ?></h2>
                        </div>
                        <div class="col-2">
                            <h2 id="controlBtns" class="text-right">
                                <?php require "../includes/functions.php"; ?>
                                <?php if (hasMovie($con, $movieId) === false): ?>
                                    <i id="addMovie" class="fa fa-plus"
                                       onclick="addMovie(<?php echo $movieId . ", '" . $movie["m_title"] . "'"; ?>);"></i>
                                <?php else: ?>
                                    <i id="removeMovie" class="fa fa-times"
                                       onclick="removeMovie(<?php echo $movieId . ", '" . $movie["m_title"] . "'"; ?>);"></i>
                                <?php endif; ?>
                            </h2>
                        </div>
                    </div>
                <?php else: ?>
                    <h2><?php echo "${movie["m_title"]} - (" . date('Y', strtotime($movie["m_rdate"])) . ")"; ?></h2>
                <?php endif; ?>
            </div>
            <div class="card-body" id="movieInfo">
                <div class="row">
                    <div class="col-4">
                        <img style="width: 350px; height: 524px;" src="<?php echo $img_url; ?>"
                             alt="<?php echo "${movie["m_title"]} image"; ?>">
                    </div>
                    <div class="col-5">
                        <p>Title: <span class="focus"><?php echo $movie['m_title']; ?></span></p>
                        <p>Movie Id: <span class="focus"><?php echo $movie["m_id"]; ?></span></p>
                        <p><i class="fa fa-clock"></i> Length: <span
                                    class="focus"><?php echo formatTime($movie['m_length']); ?></span></p>
                        <p><i class="fa fa-filter"></i> Categorie(s): <span
                                    class="focus"><?php foreach ($genres as $item) {
                                    echo $item["g_title"] . ", ";
                                } ?></span></p>
                        <p><i class="fa fa-calendar-alt"></i> Release date: <span
                                    class="focus"><?php echo date('Y - M - d', strtotime($movie['m_rdate'])); ?></span>
                        </p>
                        <p>Description:
                            <textarea style="width: 700px; height: 260px; resize: none;"
                                      readonly><?php echo $movie["m_des"]; ?></textarea>
                        </p>
                    </div>
                    <div class="col-3">
                        <a target="_blank"
                           href="https://www.youtube.com/results?search_query=<?php echo $movie['m_title']; ?> trailer"
                           class="btn btn-dark btn-block">Movie trailer</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
include "../includes/footer.php";
?>