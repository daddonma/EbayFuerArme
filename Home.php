<html>
    <?php
    session_start();
    ?>
    <head>
        <meta charset="UTF-8">
        <title>EBay für Arme - Login</title>
        <link rel="stylesheet" type="text/css" href="Style.css" />
    </head>
    <body>
       
       <?php 
            echo "Login erfolgreich als " . $_SESSION['username'] . "<br>";
            $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die (mysql_error());
            echo "Herzlich Willkommen bei Ebay für arme.<br><br>";
            
            if(!isset($_POST["suche"])) {
                $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                      FROM produkte, kategorie, user, auktion
                      WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt;";
                $result = mysqli_query($dbConnect, $query);
            }
            else {
                 $query = "SELECT produkte.PID, produkte.Bezeichnung AS 'Bezeichnung', kategorie.Bezeichnung AS 'Kategorie', user.Username AS 'Anbieter', auktion.aktuelles_gebot
                      FROM produkte, kategorie, user, auktion
                      WHERE produkte.Anbieter = User.uid AND produkte.KategorieID = kategorie.KID AND produkte.PID = auktion.Produkt AND produkte.Bezeichnung = '".$_POST['suche']."';";
                                        // echo $query;
                 $result = mysqli_query($dbConnect, $query);

            }
            
        ?>
          <form action="Home.php" method="POST">
            Suchen: <input type="text" name="suche">
            <input type="submit" value="suche">
            
        </form>
         
      
        Angebotene Artikel: <br>
        <table>
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
           
           while($row=mysqli_fetch_row($result)) {
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
            <input type="submit" value = "neues Produkt anbieten">
            <!--<input type="textarea" id="123" style="widht:500px; height: 400px">-->
        </form>
         

    </body>
</html>
