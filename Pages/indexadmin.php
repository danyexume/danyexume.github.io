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
                    <a class="nav-link active" href="../index.php"> ACCUEIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="indexadmin.php?lien=location">LOCATIONS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="indexadmin.php?lien=inventaire">INVENTAIRE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="indexadmin.php?lien=clients">CLIENTS</a>
                </li>
                
            </ul>            
          </div>
    		  <div class="col-3 contentLbl">
            <a class="nav-link cart" href="../Panieradmin/panier.php"><img src = "../Images/shoppingcart.png" /></a>
              <label id = "lbl_entete"> Magasin Scolaire </label>
          </div>
          <div class="col-3 contentLogo">
      			 <img src = "../Images/teccart_logo_white_250.png" class="img-responsive logoTeccart" alt = "Teccart Logo" />
    		  </div>	
  		</div>
      <div>
        <div>
            
        </div>
      <!-- <form action = "indexadmin.php" method = "GET"> -->
  		<div class="row">
    		<div class="col-sm">
          <center>
            <p> 
              <?php                
                $lenom = $_SESSION["nomComplet"];                
                echo "Bonjour " . $lenom . "<br/>";
                echo "Première connexion au site :" . $_COOKIE['Cookiee_Date'] . "<br/> Depuis l'adresse IP " . $_COOKIE['Cookie_Ip'];
              ?>
            </p>
              <?php
                if(isset($_GET['lien'])){
                  switch($_GET['lien'])
                  {
                    case 'location':
                     include '../Pages/locationAdmin.php';         
                    break;    
                    case 'inventaire':
                      include '../Pages/inventaireAdmin.php';
                    break;
                    case 'clients':
                      include '../Pages/clientsAdmin.php';
                    break;
                  }
                }
              ?>
      			<!-- </form> -->
          </center>
    		</div>    		
  		</div>
    </div>
  </div>
  <script src = "../Script/script.js"></script>
</body>
</html>