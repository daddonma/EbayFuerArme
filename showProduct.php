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
                        <a class="navbar-brand" href="#">WebSiteName</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li> 
                        <li><a href="#">Page 3</a></li> 
                    </ul>
                </div>

            </nav>
            <div class="col-sm-4">
                <img src="Logo.png" width="150px" height="150px">
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


                $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
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
            } ?>
                <div class="col-sm-4">

                    <h1><?php echo $bezeichnung; ?><br></h1>

                    <label>Kategorie: </label> <?php echo $kategorie; ?><br>
                    <label>Anbieter: </label> <?php echo $anbieter; ?><br>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <label>EUR: </label> <?php echo $gebot; ?><br><br>
                    </div>

                    <div class="row">
                        <form action="showProduct.php" method="GET">
                            <label for="gebot">Gebot</label> 
                    </div>
                    <div class="row">
                        <input type="number" name="gebot" class="form-control">
                    </div>

                    <div class="row">
                        <input name="Artikel" type="hidden" value="<?php echo $artikelnr ?>">
                        <input type="submit" value="Gebot abgeben" class="btn btn-primary btn-block">
                    </div>
                    <div class="row">
                        <input type="submit" value="Sofort kaufen" class="btn btn-primary btn-block">
                    </div>
                </div>
            </div>
            <a href="home.php">Zurück</a>
</form>

</body>
</html>