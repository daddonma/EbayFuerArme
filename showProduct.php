<link rel="stylesheet" type="text/css" href="Style.css" />
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die (mysql_error());
if(!isset($_GET["Artikel"])) {
    
    echo "Es ist ein Fehler aufgetreten";
    
} else {
     $artikelnr = $_GET["Artikel"];
     
      if(isset($_GET['gebot'])) {
          
          $query_gebot = "SELECT aktuelles_gebot FROM auktion WHERE Produkt = " . $artikelnr;
          
          $result = mysqli_query($dbConnect, $query_gebot);
          $row=mysqli_fetch_row($result);
          $hoechstes_gebot = $row[0];
           
          $gebot = $_GET['gebot'];
        
         //Überprüfen ob Eingabe höher ist ales aktuelles Gebot 
        if($gebot > $hoechstes_gebot) {
            $update = "UPDATE auktion SET aktuelles_gebot=".$gebot." WHERE Produkt=".$artikelnr.";";
        //echo $update;
        if ($dbConnect->query($update) === TRUE) {
            echo "Gebot erfolgreich abgegeben";
        }
       }else {
           echo "Gebot zu niedrig";
       }
    }
    
     $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                      FROM produkte, kategorie, user, auktion
                      WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.PID = " . $artikelnr . ";";
    
   //  echo $query;
    $result = mysqli_query($dbConnect, $query);
    $row=mysqli_fetch_row($result);
    
      $produktID = $row[0];
      $bezeichnung = $row[1];
      $kategorie = $row[2];
      $anbieter = $row[3];
      $gebot = $row[4];
    ?>

        Sie haben folgenden Artikel ausgewählt: <br>
        <label>Bezeichnung:  </label> <?php echo $bezeichnung;?><br>
        <label>Kategorie: </label> <?php echo $kategorie;?><br>
        <label>Anbieter: </label> <?php echo $anbieter;?><br>
        <label>Höchstgebot: </label> <?php echo $gebot;?><br><br>
        
        <form action="showProduct.php" method="GET">
            <label for="gebot">Gebot</label> <input type="number" name="gebot">
            <input name="Artikel" type="hidden" value="<?php echo $artikelnr ?>">
            <input type="submit" value="Gebot abgeben">
        </form>
        
        <a href="home.php">Zurück</a>
    <?php
    
    
}