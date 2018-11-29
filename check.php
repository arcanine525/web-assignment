<input type="text" oninput="checkusername()" id="uname" placeholder="Your username for check" class="oshe">

<span id="usernamestatus"></span>

//ajax script on the same page do not make a new file function checkusername
<script> function checkusername() {
        var status = document.getElementById("usernamestatus");
        var u = document.getElementById("uname").value;
        if (u != "") {
            status.innerHTML = '<b style="color:red;">checking...</b>';
            var hr = new XMLHttpRequest();
            hr.open("POST", "a.php", true);
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if (hr.readyState == 4 && hr.status == 200) {
                    status.innerHTML = hr.responseText;
                }
            }
            var v = "name2check=" + u;
            hr.send(v);
        }
    }
</script>


//the php script to search database
<?php
if (isset($_POST["name2check"]) && $_POST["name2check"] != "") {
    include_once 'connect.php';
    $username = ($_POST['name2check']);
    $sql_uname_check = mysqli_query($con, "SELECT matric FROM users WHERE matric='$username' LIMIT 1");
    $uname_check = mysqli_num_rows($sql_uname_check);
    if (strlen($username) < 2) {
        echo '<b style="color:white;">2 - 35 characters please</b>';
        exit();
    }
    if (!filter_var($username, FILTER_VALIDATE_EMAIL) === false) {
        echo '<b style="color:white;">Email not allowed</b>';
        exit();
    }
    if (is_numeric($username[0])) {
        echo '<b style="color:white;">First character must be a letter</b>';
        exit();
    }
    if ($uname_check < 1) {
        echo '<strong style="color:white; text-transform:lowercase!important;">' . $username . ' is available </strong> ';
        exit();
    } else {
        echo '<strong style="color:white; text-transform:lowercase!important;">' . $username . ' is taken </strong>';
        exit();
    }
}
?>