<?php
include "database.php";

session_start();

$_SESSION['logged-in'] = (!isset($_SESSION['logged-in'])) ? false : $_SESSION['logged-in'];
$_SESSION['loginFailed'] = (!isset($_SESSION['loginFailed'])) ? false : $_SESSION['loginFailed'];
$_SESSION['username'] = (!isset($_SESSION['username'])) ? '' : $_SESSION['username'];
$_SESSION['password'] = (!isset($_SESSION['password'])) ? '' : $_SESSION['password'];
$_SESSION['userId'] = (!isset($_SESSION['userId'])) ? 0 : $_SESSION['userId'];
$_SESSION['joinDate'] = (!isset($_SESSION['joinDate'])) ? 0 : $_SESSION['joinDate'];
$_SESSION['moderator'] = (!isset($_SESSION['moderator'])) ? 0 : $_SESSION['moderator'];

if ($_SESSION['username'] === '')
    $_SESSION['logged-in'] = false;
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $en_password = md5($password . "pass");
    $sql = "select * from user where u_name = '$username'";
    $query = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows == 1) {
        include "./header.php";
        echo '<body>
		<div class="jumbotron" style="height: 100vh; padding: 250px;">
			<h1 class="display-1 text-center"><i class="fas fa-bug"></i> Ops, error!</h1>
			<hr>
			<p class="text-center">There were some problems please try again.</p>
			<div class="row">
				<div class="col">
					<a href="\movies-library\index.php" class="btn btn-dark btn-lg btn-block" target="_self">Go to the main page</a>
				</div>
			</div>
		</div>
	</body>';
        include "./footer.php";

    } else {
        $query = "INSERT INTO user (u_name, u_pass) VALUES ('$username', '$en_password')";
        mysqli_query($con, $query);
        include "./header.php";
        echo '<body>
		<div class="jumbotron" style="height: 100vh; padding: 250px;">
			<h1 class="display-1 text-center"><i class="fas fa-check-circle"></i>Register successfully!</h1>
			<hr>
			<p class="text-center">You are member now.</p>
			<div class="row">
				<div class="col">
					<a href="\movies-library\index.php" class="btn btn-dark btn-lg btn-block" target="_self">Go to the main page</a>
				</div>
			</div>
		</div>
	</body>';
        include "./footer.php";
//        header("Location: \movies-library\index.php");
    }
}
