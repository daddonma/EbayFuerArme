<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<script type="text/javascript">
    function openPopUP() {
        fenster = window.open("CreateAccount.php", "neu anmelden", "width=600,height=400,status=yes,scrollbars=yes,resizable=yes");
        fenster.focus();
    }
</script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EBay für Arme - Login</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="JavaScript/js_data.js"></script>
        <script type="text/javascript" src="JavaScript/Login.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="CSS/customCSS.css" />

    </head>
    <body class="background-img">
        <div class="container-fluid">neu

            <div class="row">

                <div class="col-sm-4">
                    <div class="whiteBox">
                        <div id="InputElements" class="fade-in two">
                            Bitte loggen Sie sich ein: <br><br>
                            <label for="username">Benutzername:</label> <input type="text" id="username" class="form-control"><br>
                            <label for="pw">Passwort:</label> <input type="password" id="pw" class="form-control"> <br><br>
                            <input id="login" type="submit" value="LogIn" class="btn btn-primary btn-hover btn-active">

                            </input> 
                            <input id="anmelden" type="button" value="Neu anmelden" onclick="openPopUP();" class="btn btn-primary btn-hover btn-active">

                            </input><br>
                            <span id="authFail" style="color: red"> Benutzername und/oder Passwort falsch. Bitte erneut versuchen!</span>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
