<?php


if (isset($_POST["name2check"]) && $_POST["name2check"] != "") {
    require_once "database.php";
    $username = ($_POST['name2check']);
    $sql = "select * from user where u_name = '$username'";
    $query = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($query);

    if ($num_rows == 1) {
        echo '<strong style="color:white; text-transform:lowercase!important;">' . $username . ' is taken </strong>';;
    }
    echo '<strong style="color:white; text-transform:lowercase!important;">' . $username . ' is available </strong> ';
}
