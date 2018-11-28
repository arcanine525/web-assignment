<?php
    include "database.php";
   	
	if(isset($_POST['username']) and isset($_POST['password'])) {
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password =  mysqli_real_escape_string($con, $_POST['password']);
//        $sql = "select * from members where email = '$username' and password = '$en_password' ";
//        if ($num_rows == 1) {
//            return true;
//        }
//        return false;
//
//        function checkUser($username, $password)
//        {
//            $db = connectDB();
//            global $MY_KEY;
//
//
//            $query = mysqli_query($db, $sql);
//            $num_rows = mysqli_num_rows($query);
//
//            if ($num_rows == 1) {
//                return true;
//            }
//            return false;
//        }
        $query = "INSERT INTO user (u_name, u_pass) VALUES ('$username', '$password')";
		mysqli_query($con, $query);
		header("Location: \movies-library\index.php");
	}
