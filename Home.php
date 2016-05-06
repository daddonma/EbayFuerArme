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
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="CSS/customCSS.css" />
    </head>
    <body>
        
         <div class="jumbotron">
    <h1>Ebay Für Arme</h1> 
    <p>Alles nur geklaut</p> 
</div>


        <?php
        echo "Login erfolgreich als " . $_SESSION['username'] . "<br>";
        $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die(mysql_error());
        echo "Herzlich Willkommen bei Ebay für arme.<br><br>";

        //Falls nach etwas gesucht wird
        if (isset($_POST["suche"])) {
            switch($_POST["suche_nach"]) {
                //Suche nach Artikel
                case "Artikel":
                    $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                    FROM produkte, kategorie, user, auktion
                    WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.Bezeichnung = '" . $_POST['suche'] . "';";
                    break;
                //Suche nach Kategorie
                case "Kategorie":
                    $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                    FROM produkte, kategorie, user, auktion
                    WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.KategorieID=
                    (SELECT KID FROM kategorie WHERE Bezeichnung ='" . $_POST['suche'] . "');";
                    break;
                case "Anbieter":
                    $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                    FROM produkte, kategorie, user, auktion
                    WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.Anbieter = 
                    (SELECT uid FROM user WHERE username='" . $_POST['suche'] . "');";
                    break;
            }
        //Falls nach nichts gesucht wird   
        } else {
            $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                      FROM produkte, kategorie, user, auktion
                      WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt;";
        }
           $result = mysqli_query($dbConnect, $query);
        ?>

        <form action="Home.php" method="POST">
            Suche: <input id="suche" name="suche" type="text">
            Suchen nach: 
            <select name="suche_nach">
                <option>Artikel</option>
                <option>Kategorie</option>
                <option>Anbieter</option>
            </select>
            <input type="submit" value="suchen"><br>
            <a href="Home.php">alles anzeigen</a>
        </form>
        <br>
       

        Angebotene Artikel: <br>
        <table class="table stripped-table table-bordered table-hover table-condensed active">
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
            <input type="submit" value = "neues Produkt anbieten" class="btn btn-primary">
            <!--<input type="textarea" id="123" style="widht:500px; height: 400px">-->
        </form>


    </body>
</html>