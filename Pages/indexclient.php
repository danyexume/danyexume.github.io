<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Magasin Scolaire - Accueil - Admin</title>
  <meta charset = "UTF-8"/>
	<link rel = "StyleSheet" href = "../Style/style.css" type = "text/css" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>

<body class = "Body adminBody">
    <div class="container backContainer">
        <div class="row enteteTeccart">
          <div class = "col-6">
            <ul class="nav navbar"> 
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"> ACCUEIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">LOCATIONS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Panier/panier.php">PANIER</a>
                </li>
            </ul>            
          </div>
    		  <div class="col-3 contentLbl">
              <label id = "lbl_entete"> Magasin Scolaire </label>
          </div>
          <div class="col-3 contentLogo">
      			 <img src = "../Images/teccart_logo_white_250.png" class="img-responsive logoTeccart" alt = "Teccart Logo" />
    		  </div>	
  		</div>
      <div>
        <div>
            
        </div>
  		<div class="row">
    		<div class="col-sm">
          <center>
            <form method = "POST" action = "indexclient.php">
            <h3> 
              <?php
                $lenom = $_SESSION["nomComplet"];
                echo "Bonjour " . $lenom;
              ?>
            </h3>
            <div>
              <h1> Vos équipements en location </h1>
              <table>
                <tr>
                  <th colspan="8">NoSerie</th>
                  <th colspan="8">Date de location</th>
                  <th colspan="8">Date de retour</th>
                </tr>
                <tr>
                  <?php 
                    include '../Pages_Backend/connexionBD.php';
                    membreEquipement($_SESSION["utilisateur"]);
                  ?>
                </tr>
              </table> 
            </div>
              <h4>Évitez les frais de retard!</h4>
            <p>Merci de remettre les équipements dans les délais prescrits.</p>
            <input type = "submit" name = "quitter" value = "QUITTER"/>
            <?php
              if(isset($_POST['quitter'])){
                session_destroy();
                header("location: ../index.php");
              }
              else
              {
                //header("location: /Pages/indexclient.php");
              }
            ?>
      			</form>
          </center>
    		</div>    		
  		</div>
    </div>
  </div>
</body>
</html>