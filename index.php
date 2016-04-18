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
   </head>
<link rel="stylesheet" type="text/css" href="CSS/Login.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="JavaScript/js_data.js"></script>
<script type="text/javascript" src="JavaScript/Login.js"></script>
  
    <header>
        <img  src="Images/Logo.png" alt="" class="fade-in ,one" width="25%" height="25%"> 
    </header>
    <body>
        
    <div id="InputElements" class="fade-in two">
                Bitte loggen Sie sich ein: <br><br>
                <label for="username">Benutzername:</label> <input type="text" id="username"><br>
                <label for="pw">Passwort:</label> <input type="password" id="pw"> <br><br>
                <input id="login" type="submit" value="LogIn"></input> 
                <input id="anmelden" type="button" value="Neu anmelden" onclick="openPopUP(); return false"></input><br>
                <span id="authFail" style="color: red"> Benutzername und/oder Passwort falsch. Bitte erneut versuchen!</span>
    </div>
    </body>
</html>
