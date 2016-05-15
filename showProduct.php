<html>
    <head>  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="CSS/customCSS.css" />
    </head>
    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="home.php">PayBay</a>
                    </div>
                    <ul class="nav navbar-nav">
                    </ul>
                </div>
            </nav>

            <?php
           
            session_start();
             echo $_SESSION['uid'];
            $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die(mysql_error());
            if (!isset($_GET["Artikel"])) {

                echo "Es ist ein Fehler aufgetreten";
            } else {
                $artikelnr = $_GET["Artikel"];

                if (isset($_GET['gebot'])) {

                    $query_gebot = "SELECT aktuelles_gebot FROM auktion WHERE Produkt = " . $artikelnr;

                    $result = mysqli_query($dbConnect, $query_gebot);
                    $row = mysqli_fetch_row($result);
                    $hoechstes_gebot = $row[0];

                    $gebot = $_GET['gebot'];

                    //Überprüfen ob Eingabe höher ist ales aktuelles Gebot 
                    if ($gebot > $hoechstes_gebot) {
                        $update_gebot = utf8_decode("UPDATE auktion SET aktuelles_gebot=" . $gebot . ", Höchstbietender = " . $_SESSION['uid'] . " WHERE Produkt=" . $artikelnr . ";");
                       $update_auktion = mysqli_query($dbConnect, $update_gebot) or die(mysqli_error($dbConnect));
                       
                       if($update_auktion === TRUE) {
                           echo "Gebot erfolgreich abgegeben";
                       }
                        //echo $update_gebot;
                        
                        
                    } else {
                        echo "Gebot zu niedrig";
                    }
                }
                $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot, produkte.Text, to_days(Auktion_ende) - to_days(current_date()) AS 'Restzeit', images.datei 
                      FROM produkte, kategorie, user, auktion, images
                      WHERE produkte.ImageID = images.ImageID AND produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.PID = " . $artikelnr . ";";

                //echo $query;
                $result = mysqli_query($dbConnect, $query);
                $row = mysqli_fetch_row($result);


                $produktID = $row[0];
                $bezeichnung = $row[1];
                $kategorie = $row[2];
                $anbieter = $row[3];
                $gebot = $row[4];
                $beschreibung = $row[5];
                $restzeit = $row[6];
                $image = $row[7];
            }
            
          
                
            
            ?>
           
             <div class="col-sm-4">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($image) .'" class="img-thumbnail">';?>
            </div>
            <form action="showProduct.php" method="GET">
                <div class="col-sm-4">
                    <h1><?php echo $bezeichnung; ?></h1>
                    <label>Kategorie: </label> <?php echo $kategorie; ?><br>
                    <label>Anbieter: </label> <?php echo $anbieter; ?><br>
                </div>
                <?php
                  if($restzeit <0) {
                echo "<b><font color=red>Die Auktion wurde für ". $gebot ." Euro erfolgreich beendet. Sie können nicht mehr bieten.</b></font>";
                  
            }else {
                
            ?>
                <div class="col-sm-4">
                    <div class="row">
                        <label>EUR: </label> 
                        <?php echo $gebot; ?>
                    </div>
                    <div class="row">
                        <label for="gebot">Gebot</label> 
                    </div>
                    <div class="row">
                        <label>
                             <?php 
                        if($restzeit == 0) {
                        echo "<b><font color=red>Auktion endet heute!</b></font>";
                            
                         } else { echo "Restzeit: " . $restzeit . " Tage";}
                         ?>
                            
                        </label>
                       
                    </div>
                    <div class="row">
                        <input type="number" name="gebot" class="form-control">
                    </div>
                    <div class="row">
                        <input name="Artikel" type="hidden" value="<?php echo $artikelnr ?>">
                        <input type="submit" value="Gebot abgeben" class="btn btn-primary btn-block btn-hover btn-active">
                    </div>
                   <!-- <div class="row">
                        <input type="submit" value="Sofort kaufen" class="btn btn-primary btn-block">
                    </div>-->
                </div>
                <?php
            }
                ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h4>Beschreibung:</h4>
                <blockquote>   <p><?php echo $beschreibung?></p></blockquote>
                <a href="home.php" class="btn btn-primary">Zurück</a>
            </div>
        </div>
    </form>
</body>
</html>