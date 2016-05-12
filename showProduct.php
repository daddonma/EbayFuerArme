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
            <div class="col-sm-4">
                <img src="CSS/Images/platzhalter.svg" class="img-thumbnail">
            </div>
            <?php
            /*
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */
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
                        $update = "UPDATE auktion SET aktuelles_gebot=" . $gebot . " WHERE Produkt=" . $artikelnr . ";";
                        //echo $update;
                        if ($dbConnect->query($update) === TRUE) {
                            echo "Gebot erfolgreich abgegeben";
                        }
                    } else {
                        echo "Gebot zu niedrig";
                    }
                }


                $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot, produkte.Text, to_days(Auktion_ende) - to_days(current_date()) AS 'Restzeit' 
                      FROM produkte, kategorie, user, auktion
                      WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.PID = " . $artikelnr . ";";

                //  echo $query;
                $result = mysqli_query($dbConnect, $query);
                $row = mysqli_fetch_row($result);


                $produktID = $row[0];
                $bezeichnung = $row[1];
                $kategorie = $row[2];
                $anbieter = $row[3];
                $gebot = $row[4];
                $beschreibung = $row[5];
                $restzeit = $row[6];
            }
            
          
                
            
            ?>
            <!-- die Form noch richtig schieben -->
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
                        <input type="number" name="gebot" class="form-control">
                    </div>
                    <div class="row">
                        <input name="Artikel" type="hidden" value="<?php echo $artikelnr ?>">
                        <input type="submit" value="Gebot abgeben" class="btn btn-primary btn-block btn-hover btn-active">
                    </div>
                    <div class="row">
                        <input type="submit" value="Sofort kaufen" class="btn btn-primary btn-block">
                    </div>
                </div>
                <?php
            }
                ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h4>Beschreibung:</h4>
                <blockquote>  <!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                              </p>--> <p><?php echo $beschreibung?></p></blockquote>
                                            <a href="home.php" class="btn btn-primary">Zurück</a>

            </div>
        </div>
    </form>
</body>
</html>