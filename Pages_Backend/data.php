<?php

	$lecode = $_GET["val"];
	$connect = mysqli_connect('localhost','root','','MagasinScolaire') or die("Erreur, connexion a MySQL echouee.");
	$requetePrenom = "SELECT * FROM membre WHERE Code = '" . $lecode ."';";
	$requete = mysqli_query($connect, $requetePrenom) or die("Erreur, selection prenom echouee.");
	$firstname = $lastname = $password = "";
	$data[] = array();
	while ($donnees = mysqli_fetch_row($requete))
	{ 
		$data[0] = $donnees[1];
		$data[1] = $donnees[2];
		$data[2] = $donnees[4];
	}

 //echo "Hello " . $firstname;
 echo json_encode($data);

?>