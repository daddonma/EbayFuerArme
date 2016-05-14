<?php
session_start();
$dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die (mysql_error());

$username = $_POST['username'];

//Anzahl der Nutzer mit diesem Nutzernamen
$query_count_username = "SELECT count(uid) AS 'anz_Nutzer' FROM user WHERE username = '".$username."';";
$daten_anz_Nutzer = mysqli_query($dbConnect, $query_count_username);
$row = mysqli_fetch_row($daten_anz_Nutzer);
$anz_Nutzer = $row[0];

//Falls der Nutzer noch nicht existiert
if($anz_Nutzer == 0) {
    
    $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die (mysql_error());
                
    $insert = "INSERT INTO USER (Username, Passwort) VALUES ('".$_POST['username']."', '". md5($_POST['pw'])."');";
    $doInsert = mysqli_query($dbConnect, $insert);           
    echo "true";
}else {
    echo "false";
}
