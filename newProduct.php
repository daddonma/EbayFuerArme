<?php
session_start();
 $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die (mysqli_error());
 $kategorien = "SELECT KID, Bezeichnung FROM kategorie";
 $result = mysqli_query($dbConnect, $kategorien);

?>
<link rel="stylesheet" type="text/css" href="Style.css" />


<form action ="newProduct.php" method="POST">
    <label for="bezeichnung">Artikelbezeichnung: </label> <input type="text" name="bezeichnung" value=""><br>
    <label for="kategorie">Kategorie</label><select name="kategorie"> 
<?php 
   while ( $row=mysqli_fetch_assoc($result)) { 
                      echo '<option value="'.$row['KID'].'">'.$row['Bezeichnung'].'</option>'; 
                  }  
?> 
    </select><br>
    <label for="beschreibung">Artikelbeschreibung: </label> <input style="height:300px" type="textarea" name="beschreibung" value="">
    <label for="startpreis">Startpreis</label> <input type="text" name="startpreis" value=""><br>
    <input type="submit" value="Angebot erstellen">
</form>
<a href="Home.php">Zurück</a>
<?php
if(isset($_POST['kategorie'])) {
    $bezeichnung = $_POST['bezeichnung'];
    $kategorie = $_POST['kategorie'];
    $beschreibung = $_POST['beschreibung'];
    $starpreis = $_POST['startpreis'];
    
    $insert = "INSERT INTO produkte(Bezeichnung, KategorieID, Anbieter, Text, Startpreis) VALUES"
            ."('".$bezeichnung."', ".$kategorie.", ".$_SESSION['uid'].", '".$beschreibung."', ".$starpreis.");";
    

    //echo $insert;
    if ($dbConnect->query($insert) === TRUE) {
            echo "Auktion erfolgreich gestartet";             
                } else {
                        echo "Error";
                 }
      
         
   
            
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

