<?php 
  session_start(); 
  if(count($_COOKIE) > 0) {
                            $dateCookie = $_COOKIE['Cookiee_Date'];
                            $ipCookie = $_COOKIE['Cookie_Ip'];
                          } 
                          else {
                            setcookie("Cookiee_Date", date('d-m-Y H:i:s'), time() + (86400 * 365), "/" , "localhost", 0);
                            setcookie("Cookie_Ip", $_SERVER['REMOTE_ADDR'], time() + (86400 * 365), "/" , "localhost", 0);
                            
                            $dateCookie = $_COOKIE['Cookiee_Date'];
                            $ipCookie = $_COOKIE['Cookie_Ip'];
                          }  
  
?>
<!DOCTYPE HTML>
<html>
  <head>
  	<title>Magasin Scolaire - Connexion</title>
    <meta charset = "UTF-8"/>
  	<link rel = "StyleSheet" href = "./Style/style.css" type = "text/css" />


  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  </head>

  <body class = "Body">
    <div class="container">
        <div class="row">
    		<div class="col-lg-5 col-sm test1">
      			<img src = "Images/teccart_logo_400.png" class="img-responsive foto" alt = "Teccart Logo" />	
    		</div>    		
  		</div>
  		<div class="row">
    		<div class="col-sm">
          <center>
      			<form action ="index.php" method = "post">
              <div class="form-group middle">
      				<table class="board_back">
      					<tr><h2 id = "enteteIndex"> Magasin Scolaire </h2></tr><br/>
      					<tr> <td colspan="8"><input id = "usrName" name = "usrName" class="connect_input connect_input_txt" type = "text" placeholder = "Code d'accès..." /></td></tr>
                <tr><td colspan="8"> <input id = "pwd" name = "pwd" class="connect_input connect_input_txt" type = "password" placeholder = "Mot de passe..." /></td></tr>
                <tr><td colspan="8"><p id = "authenErreur"></p></td></tr>
      					<tr><td colspan="4"> <input id = "boutonConnexion" name = "boutonConnexion" class="btn btn-outline-primary connect_input" type = "submit" value = "Se Connecter"/></td></tr>
      				</table>
              <?php
                  include 'Pages_Backend/connexionBD.php';
                  $usrname = "";
                  $password = "";
                  if (isset($_POST["boutonConnexion"]))
                  {
                     $usrname = $_POST["usrName"];
                      $password = $_POST["pwd"];
                      if($usrname == ""  or $password == "")
                      {
                          //header("Location: index.php");
                        echo "<script>alert('erreur');</script>";
                      }

                      else
                      {   
                      //echo "<script>alert('ca passe');</script>";                    
                        $utilisateur = authentifyun($usrname);
                        $nomComplet = authentifypw($utilisateur, $password);

                        if($utilisateur == "" ||$nomComplet == "")
                        {
                            echo "<script>document.GetElementById(\"authenErreur\").innerHTML = \" Nom ou mot de passe invalide!\";</script>";
                        }

                        else 
                        {
                          $_SESSION["utilisateur"] = $utilisateur;
                          $_SESSION["nomComplet"] = $nomComplet;

                          if(count($_COOKIE) > 0) {
                            $dateCookie = $_COOKIE['Cookiee_Date'];
                            $ipCookie = $_COOKIE['Cookie_Ip'];
                          } 
                          else {
                            
                            $dateCookie = $_COOKIE['Cookiee_Date'];
                            $ipCookie = $_COOKIE['Cookie_Ip'];
                          }
                          
                          adminMembre(testStatut($usrname, $password));
                        } 
                      } 
                    }                  
                ?>
              
              </div>
      			</form>
          </center>
    		</div>    		
  		</div>
    </div>
  </body>
</html>