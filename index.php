<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<script type="text/javascript">

</script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EBay für Arme - Login</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="CSS/Login.css" /> -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="JavaScript/js_data.js"></script>
        <script type="text/javascript" src="JavaScript/Login.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>


    <header>
        <img  src="Images/Logo.png" alt="" class="fade-in ,one" width="25%" height="25%"> 
    </header>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">

                    <div id="InputElements" class="fade-in two">
                        Bitte loggen Sie sich ein: <br><br>
                        <label for="username">Benutzername:</label> <input type="text" id="username" class="form-control"><br>
                        <label for="pw">Passwort:</label> <input type="password" id="pw" class="form-control"> <br><br>
                        <input id="login" type="submit" value="LogIn"class="btn btn-primary btn-lg">

                        </input> 
                        <input id="anmelden" type="button" value="Neu anmelden" onclick="openPopUP();
        return false" class="btn btn-primary btn-lg">

                        </input><br>
                        <span id="authFail" style="color: red"> Benutzername und/oder Passwort falsch. Bitte erneut versuchen!</span>

                    </div>
                </div>
                <div class="col-sm-4">
                </div>

            </div>
        </div>
    </body>
</html>
