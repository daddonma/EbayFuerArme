<html>
  
    <head>
        <meta charset="UTF-8">
        <title>Account erstellen</title>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="CSS/customCSS.css" />
    </head>
    <body>
        <div class="container-fluid">
   
        <?php if(!isset ($_POST['username']) && !isset ($_POST['pw'])) {?>
        <form method="Post" action="createAccount.php">
            <div class="row">
                <div class="col-sm-1">
            <label for="username">Benutzername:</label>
                </div>
                <div class="col-sm-11">
            <input type="text" name="username" id="newUsername" class="form-control"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1">
            <label for="pw">Passwort:</label>
                </div>
                <div class="col-sm-11">
            <input type="password" name="pw" id="newPW" class="form-control"> <br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
            <input id="create" type="submit" value="Account erstellen" class="btn btn-primary"></input> 
                </div>
            </div>
            <?php
        } else {
            
                $dbConnect = mysqli_connect("localhost", "root", "", "ebayfuerarme") or die (mysql_error());
                
                $insert = "INSERT INTO USER (Username, Passwort) VALUES ('".$_POST['username']."', '". $_POST['pw']."');";
                
                if ($dbConnect->query($insert) === TRUE) {
                        echo "Benutzer erfolgreiche erstellt";
                } else {
                        echo "Error";
                 }
        }    
            ?>
        </form>
    </body>
</html>
