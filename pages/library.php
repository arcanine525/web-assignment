<?php
session_start();

$_SESSION['logged-in'] = (!isset($_SESSION['logged-in'])) ? true : $_SESSION['logged-in'];
$_SESSION['loginFailed'] = (!isset($_SESSION['loginFailed'])) ? false : $_SESSION['loginFailed'];
$_SESSION['username'] = (!isset($_SESSION['username'])) ? '' : $_SESSION['username'];
$_SESSION['password'] = (!isset($_SESSION['password'])) ? '' : $_SESSION['password'];
$_SESSION['userId'] = (!isset($_SESSION['userId'])) ? 0 : $_SESSION['userId'];
$_SESSION['joinDate'] = (!isset($_SESSION['joinDate'])) ? 0 : $_SESSION['joinDate'];
$_SESSION['moderator'] = (!isset($_SESSION['moderator'])) ? 0 : $_SESSION['moderator'];

if ($_SESSION['logged-in'] === false)
    header('Location: \movies-library\index.php');

include "../includes/header.php";
include "../includes/database.php";

//$query = "SELECT `movies`.`movieId`, `movies`.`title`, `movies`.`score`, `movies`.`categories` FROM `libraries` INNER JOIN `movies` ON `movies`.`movieId` = `libraries`.`movieId` WHERE `userId` = ".$_SESSION["userId"].";";
$query = "SELECT * FROM movie JOIN watchlist ON movie.m_id=watchlist.m_id JOIN user ON watchlist.u_id = user.u_id WHERE user.u_id = " . $_SESSION['userId'];
//echo $query;
$results = mysqli_query($con, $query);
$movies = mysqli_fetch_all($results, MYSQLI_ASSOC);
$i = 0;


?>
    <main class="container mt-5 mb-5">
        <h2><i class="fa fa-th-list"></i> My library - <b><?php echo sizeof($movies); ?></b> movie(s)</h2>
        <hr>
        <table class="table table-hover cursor">
            <thead class="thead-light">
            <th scope="col">#</th>
            <th scope="col">Poster</th>
            <th scope="col">Title</th>
            <th scope="col">Categories</th>
            </thead>

            <tbody id="lib">
            <?php foreach ($movies as $movie):
                $g_query = 'SELECT g_title, m_title FROM movie NATURAL JOIN mgenre NATURAL JOIN genre WHERE m_id=' . $movie["m_id"] . ';';
                $g_results = mysqli_query($con, $g_query);
                $genres = mysqli_fetch_all($g_results, MYSQLI_ASSOC);
                $img_url = 'http://image.tmdb.org/t/p/w500' . $movie["m_pic"] . "pg";
                ?>
                <tr data-href="\movies-library\pages\movie.php?movie=<?php echo $movie["m_id"]; ?>">
                    <th scope="row"><?php echo ++$i; ?> </th>
                    <td><img style="width: 50px;" src="<?php echo $img_url; ?>" alt="<?php echo $movie["title"]; ?> poster"></td>
                    <td><?php echo $movie["m_title"]; ?></td>
                    <td><span
                                class="focus"><?php foreach ($genres as $item) {
                                echo $item["g_title"] . ", ";
                            } ?></span></td>
                    <td>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
<?php
include "../includes/footer.php";
?>