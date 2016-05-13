<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
            $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die(mysqli_error());
            $kategorien = "SELECT KID, Bezeichnung FROM kategorie";
            $result = mysqli_query($dbConnect, $kategorien);
            ?>
            <link rel="stylesheet" type="text/css" href="Style.css" />

            <form action ="newProduct.php" method="POST">
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
                <div class="col-sm-12">
                    <h1>Bild hochladen</h1>

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"

                          enctype="multipart/form-data">

                        Bilddatei:<br />

                        <input type="file" name="img" ><p>

                    </form>
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
        </div>



        <?php
        if (isset($_POST['kategorie'])) {
            $bezeichnung = $_POST['bezeichnung'];
            $kategorie = $_POST['kategorie'];
            $beschreibung = $_POST['beschreibung'];
            $starpreis = $_POST['startpreis'];
            $angebotsende = $_POST['ende'];

            $insert = "INSERT INTO produkte(Bezeichnung, KategorieID, Anbieter, Text, Startpreis) VALUES"
                    . "('" . trim($bezeichnung) . "', " . trim($kategorie) . ", " . $_SESSION['uid'] . ", '" . trim($beschreibung) . "', " . $starpreis . ");";


            echo $insert;


            if ($dbConnect->query($insert) === TRUE) {
                $update_auktion_date = "UPDATE AUKTION SET Auktion_ende = '" . $angebotsende . "' WHERE PRODUKT = (SELECT PID FROM Produkte WHERE Bezeichnung='" . trim($bezeichnung) . "' AND text='" . trim($beschreibung) . "');";
                if ($dbConnect->query($update_auktion_date) === TRUE) {
                    echo "Auktion erfolgreich gestartet";
                } else {
                    echo "Fehler beim Eintragen des Angebotsendes";
                }
            } else {
                echo "Fehler beim Speichern des Produktes";
            }
        }


        if (array_key_exists('img', $_FILES)) {

            $tmpname = $_FILES['img']['tmp_name'];

            $type = $_FILES['img']['type'];

            $hndFile = fopen($tmpname, "r");

            $data = addslashes(fread($hndFile, filesize($tmpname)));

            $strQuery = "INSERT INTO images (imgdata,imgtype) VALUES('$data','$type')";

            if ($dbConnect->query($strQuery) === TRUE) {
                echo "Auktion erfolgreich gestartet";
            } else {
                echo "Error";
            }
        }
        ?>

    </div>
</form>




</body>
</html>

