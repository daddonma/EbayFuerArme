<?php 
session_start();
$dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die (mysql_error());

$pw = $_POST['pw'];
$username = $_POST['username'];

$query = "SELECT Passwort FROM User Where Username = '" . $username . "';";
$result = mysqli_query($dbConnect, $query);

    while($row=mysqli_fetch_array($result)) {
        if($row[0] == md5($pw)) {
            $_SESSION['username'] = $username;
            $query_uid = "SELECT uid FROM USER WHERE username='".$username."' AND Passwort ='".$pw."';";
            $result_uid = mysqli_query($dbConnect, $query_uid);
                while($row_uid = mysqli_fetch_array($result_uid)) {
                    $_SESSION['uid'] = $row_uid[0];
                }
            echo true;
        } else {
            echo false;
        }
    }
 

?>
