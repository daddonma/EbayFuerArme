

<html>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="JavaScript/js_data.js"></script>
    <?php
    session_start();
    ?>
    <head>
        <meta charset="UTF-8">
        <title>EBay für Arme</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="CSS/Login.css" /> -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
           <link rel="stylesheet" type="text/css" href="CSS/customCSS.css" />

    </head>
    <body>


        <div class="container-fluid">
            <div class="row">
                <div class="jumbotron">
                    <img src="logo.png" class="img-responsive" height="10%" width="10%" alt="Cinque Terre">

                    <h1>PayBay</h1> 
                    <p>Das ist alles nur geklaut</p> 
    
        </div>
        <nav class="row navbar">
            <?php
            echo "Login erfolgreich als " . $_SESSION['username'] . "<br>";
            $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die(mysql_error());
            echo "Herzlich Willkommen bei Ebay für arme.<br><br>";

            if (isset($_POST["suche"])) {
                $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                      FROM produkte, kategorie, user, auktion
                      WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.Bezeichnung = '" . $_POST['suche'] . "';";
            } else if (isset($_POST['suche_kategorie'])) {

                $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                      FROM produkte, kategorie, user, auktion
                      WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.KategorieID=
                      (SELECT KID FROM kategorie WHERE Bezeichnung ='" . $_POST['suche_kategorie'] . "');";
            } else {
                $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                      FROM produkte, kategorie, user, auktion
                      WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt;";
            }
            $result = mysqli_query($dbConnect, $query);
            ?>

            Suchen nach:<br>

            <div class="row radio-inline">
                Beschreibung: <input type="radio" id="suche_beschreibung">
                Kategorie: <input type="radio" id="suche_kategorie"><br><br>

                <form id="suchfeld_beschreibung" action="Home.php" method="POST">
                    Suchen: <input id="" type="text" name="suche">
                    <input type="submit" value="suche" class="button">
                </form>

                <form id="suchfeld_kategorie" action="Home.php" method="POST">
                    Kategorie: <input  type="text" name="suche_kategorie">
                    <input type="submit" value="suche" btn btn-primary btn-lg>
                </form>
            </div>

        </div>
        <div class="row">
    </nav>


            Angebotene Artikel: <br>
            <table class="table table-striped table-bordered table-hover table-condensed active table-responsive">
                <th>
                    <b> Bezeichnung </b>

                </th>
                <th>
                    <b>Kategorie</b>
                </th>
                <th>
                    <b> Anbieter</b>
                </th>
                <th>
                    <b>Aktuelles Gebot</b>
                </th>
                <?php
                while ($row = mysqli_fetch_row($result)) {
                    $produktID = $row[0];
                    $bezeichnung = $row[1];
                    $kategorie = $row[2];
                    $anbieter = $row[3];
                    $gebot = $row[4];
                    //echo $row[1].'<br />';
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $bezeichnung;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $kategorie;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $anbieter;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $gebot;
                            ?>
                        </td>
                        <td>
                          <!--  <input type="button" value="Produkt ansehen"></input> -->
                            <a href="ShowProduct.php?Artikel=<?php echo $produktID ?>">Artikel ansehen</a>

                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <form action="newProduct.php">
                <input type="submit" value = "neues Produkt anbieten" class="btn btn-primary btn-lg">
                <!--<input type="textarea" id="123" style="widht:500px; height: 400px">-->
            </form>

        </div>
    </div>

</body>
</html>
