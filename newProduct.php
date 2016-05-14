<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="CSS/customCSS.css" />
    </head>
    <body> 

        <!-- Navigation bar-->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="home.php">PayBay</a>
                </div>
                <ul class="nav navbar-nav">
                </ul>
            </div>
        </nav>
        <!-- Navigation bar ending -->

        <!-- Datenbank Verbindungsaufbau -->
        <?php
        session_start();
        $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die(mysqli_error());
        $kategorien = "SELECT KID, Bezeichnung FROM kategorie";
        $result = mysqli_query($dbConnect, $kategorien);
        ?>

        <div class="container-fluid">

            <div> Bitte füllen Sie alle Felder aus und laden Sie ein Bild hoch</div>
            <form action ="newProduct.php?createProduct=true" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-1">
                        <label for="bezeichnung">Artikelbezeichnung: </label> </div>
                    <div class="col-sm-8">   
                        <input type="text" name="bezeichnung" value="" class="form-control">
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-1">
                        <label for="kategorie">
                            Kategorie:
                        </label></div>
                    <div class="col-sm-11">
                        <select name="kategorie" class="form-control"> 


                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['KID'] . '">' . $row['Bezeichnung'] . '</option>';
                            }
                            ?> 

                        </select><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-1">
                        <label for="beschreibung">Artikelbeschreibung:</label> 
                    </div>
                    <div class="col-sm-11">
                        <textarea rows="10"  class="form-control" name="beschreibung">
                        </textarea>
                    </div>


                </div>

                <div class="row">
                    <div class="col-sm-1">
                        <label for="startpreis">Startpreis</label> 
                    </div>
                    <div class="col-sm-11">
                        <input type="text" name="startpreis" value="" class="form-control"><br>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-1">
                        <label for="Angebotsende">Angebotsende</label> 
                    </div>
                    <div class="col-sm-11">
                        <input type="date" name="ende" value="" class="form-control"><br>
                    </div>
                </div>
                
                 <div class="row">

                    <div class="col-sm-1">
                        <label for="img">Bild Hochladen</label> 
                    </div>
                    <div class="col-sm-11">
                        <input type="file" name="image" value="" class="form-control"><br>
                    </div>
                </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="submit" value="Angebot erstellen" class="btn btn-primary btn-block">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <a href="Home.php" class="btn btn-primary btn-block">Zurück</a>
                            </div>
                        </div




                    </form>

                </div>

                <?php
                if (isset($_GET['createProduct'])) {
                  if($_POST['bezeichnung'] != "" && $_POST['kategorie']!="" && $_POST['beschreibung'] !="" && $_POST['startpreis'] != ""  && $_POST['ende'] != "") {
                         $bezeichnung = $_POST['bezeichnung'];
                    $kategorie = $_POST['kategorie'];
                    $beschreibung = $_POST['beschreibung'];
                    $starpreis = $_POST['startpreis'];
                    $angebotsende = $_POST['ende'];
                    

                    $insert = "INSERT INTO produkte(Bezeichnung, KategorieID, Anbieter, Text, Startpreis) VALUES"
                            . "('" . trim($bezeichnung) . "', " . trim($kategorie) . ", " . $_SESSION['uid'] . ", '" . trim($beschreibung) . "', " . $starpreis . ");";


                    //echo $insert;


                    if ($dbConnect->query($insert) === TRUE) {
                        $update_auktion_date = "UPDATE AUKTION SET Auktion_ende = '" . $angebotsende . "' WHERE PRODUKT = (SELECT PID FROM Produkte WHERE Bezeichnung='" . trim($bezeichnung) . "' AND text='" . trim($beschreibung) . "');";
                        if ($dbConnect->query($update_auktion_date) === TRUE) {
                            
                            $query_max_image = "SELECT max(imageID) AS 'maxImage' FROM images;";
                            $max_image = mysqli_fetch_row(mysqli_query($dbConnect, $query_max_image))[0];
                            $image_id = $max_image+1;
                            
                            $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); 
                            $image_name = addslashes($_FILES['image']['name']);
                            
                            $img_query = "INSERT INTO `images` (`ImageID`, `datei`, `name`) VALUES (".$image_id.", '{$image}', '{$image_name}')";
                            echo "Auktion erfolgreich gestartet";
                           //echo $img_query;
                            
                            
                            if (mysqli_query($dbConnect, $img_query)) { // Error handling
                                    $query_produktID = "SELECT PID FROM Produkte WHERE Bezeichnung='" . trim($bezeichnung) . "' AND text='" . trim($beschreibung) . "';";
                                    $produktID = mysqli_fetch_row(mysqli_query($dbConnect, $query_produktID))[0];
                                    
                                    $update_img_query = "UPDATE produkte SET ImageID = ".$image_id." WHERE PID = ".$produktID.";";
                               
                                     if ($dbConnect->query($update_img_query) === TRUE) {
                                         echo "";
                                     } else {
                                         echo "Fehler beim Hochladen des Bildes";
                                     }
                                    } 
                        } else {
                            echo "Fehler beim Eintragen des Angebotsendes";
                        }
                    } else {
                        echo "Fehler beim Speichern des Produktes";
                    }
                 } else {
                     echo "Sie müssen alle Felder ausfüllen und ein Bild hochladen";
                 }
                    
                   


                }
                ?>


               




                </body>
                </html>

