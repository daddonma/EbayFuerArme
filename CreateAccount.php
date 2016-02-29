<html>
  
    <head>
        <meta charset="UTF-8">
        <title>Account erstellen</title>
<link rel="stylesheet" type="text/css" href="Style.css" />
    </head>
    <body>
   
        <?php if(!isset ($_POST['username']) && !isset ($_POST['pw'])) {?>
        <form method="Post" action="createAccount.php">
            <label for="username">Benutzername:</label> <input type="text" name="username" id="newUsername"><br>
            <label for="pw">Passwort:</label> <input type="password" name="pw" id="newPW"> <br><br>
            <input id="create" type="submit" value="Account erstellen"></input> 
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
