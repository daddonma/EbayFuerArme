<html>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="JavaScript/js_data.js"></script>
    <?php
    session_start();
    $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die(mysql_error());
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

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="home.php">PayBay</a>   
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <ul class="nav navbar-nav">
                            <li>
                                <span> Eingeloggt als <?php echo  $_SESSION['username'];?><a href="index.php">(ausloggen)</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav> 
<div class="container-fluid">
<div class="row">
        
        <form action="Home.php" method="POST" >
            <div class="row">
                <div class="col-sm-6">
                    <label for="suche"> Suche:</label>
                    <input id="suche" name="suche" type="text" class=" form-control">
                </div>
                <div class="col-sm-6">
                    <label for="suche_nach"> Suche nach:</label>
                    <select name="suche_nach" class="form-control">
                        <option>Artikel</option>
                        <option>Kategorie</option>
                        <option>Anbieter</option>
                    </select>
                </div>
                    <div class="col-sm-12">
                    <input type="submit" value="suchen" class="btn btn-primary btn-block" >
                </div>
        </div>
    </form>            

      

    <?php
         
            //Falls nach etwas gesucht wird
            if (isset($_POST["suche"])) {
               
                switch ($_POST["suche_nach"]) {
                    //Suche nach Artikel
                    case "Artikel":
                        $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot, to_days(Auktion_ende) - to_days(current_date()) AS 'Restzeit', images.datei
                    FROM produkte, kategorie, user, auktion, images
                    WHERE produkte.ImageID = images.ImageID AND produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.Bezeichnung = '" . $_POST['suche'] . "';";
                        break;
                    //Suche nach Kategorie
                    case "Kategorie":
                        $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot, to_days(Auktion_ende) - to_days(current_date()) AS 'Restzeit', images.datei
                    FROM produkte, kategorie, user, auktion, images 
                    WHERE produkte.ImageID = images.ImageID AND produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.KategorieID=
                    (SELECT KID FROM kategorie WHERE Bezeichnung ='" . $_POST['suche'] . "');";
                        break;
                    case "Anbieter":
                        $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot, to_days(Auktion_ende) - to_days(current_date()) AS 'Restzeit', images.datei
                    FROM produkte, kategorie, user, auktion, images
                    WHERE produkte.ImageID = images.ImageID AND produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.Anbieter = 
                    (SELECT uid FROM user WHERE username='" . $_POST['suche'] . "');";
                        break;
                }
                //Falls nach nichts gesucht wird   
            } else {
          
                //Dieser Query muss überprüft werden
                    $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot, to_days(Auktion_ende) - to_days(current_date()) AS 'Restzeit', images.datei
                    FROM produkte, kategorie, user, auktion, images
                    WHERE produkte.ImageID = images.ImageID AND produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt;";

            } 
                    $result = mysqli_query($dbConnect, $query);

                    while ($row = mysqli_fetch_row($result)) {
                            $produktID = $row[0];
                            $bezeichnung = $row[1];
                            $kategorie = $row[2];
                            $anbieter = $row[3];
                            $gebot = $row[4];
                            $restzeit = $row[5];
                            $image = $row[6];
                            
                            ?>
                            <div class="col-sm-2">
                                <div class="panel panel-primary">
                                    <div class="panel-body"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($image) .'" class="img-responsive style="width:100%" alt="Image"">';?></div>
                                                <div class="panel-footer">
                                                        <div class="row">
                                                            <h4 class="text-right"><?php echo $bezeichnung ?></h4>
                                                        </div>
                                                        <div class="row">
                                                            <h4 class="text-right"><?php echo ($gebot . ' €') ?></h4>
                                                        </div>
                                                        <div class="row">
                                                            <?php 
                                                        if($restzeit >0) {
                                                            echo "Restzteit: " . $restzeit . " Tage";
                                                        } else {
                                                            echo "<b><font color=red>abgelaufen</font></b>";
                                                        }
                                                        ?>
                                                        </div>
                                                        <div class="row">
                                                        <a class="btn btn-primary btn-block" href="ShowProduct.php?Artikel=<?php echo $produktID ?>">Artikel ansehen</a>
                                                        </div>
                                                    </div>
                                </div>

                            </div>
                        <?php
                            }
                        ?>
                           
    

</div> 
                                 <form action="newProduct.php">
                <input type="submit" value = "neues Produkt anbieten" class="btn btn-primary">
                <!--<input type="textarea" id="123" style="widht:500px; height: 400px">-->
            </form>

    </div>

</body>
</html>