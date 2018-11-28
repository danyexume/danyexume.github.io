<?php
	function OpenCon()
	{
		$connect = mysqli_connect('localhost','root','','MagasinScolaire') or die("Erreur, connexion a MySQL echouee.");
		return $connect;
	}

	function CloseCon($conn)
	{
		mysqli_close($conn);
 	}

 	function authentifypw($mcode, $mpassword)
 	{
 		$reponse = "";
 		$connect = OpenCon();
 		$authentif = "SELECT * FROM membre WHERE password LIKE '" . $mpassword . "' AND Code LIKE '" . $mcode . "'; ";
 		$requete1 = mysqli_prepare($connect, $authentif) or die("Erreur, selection donnees echouee.");
 		$requete2 = mysqli_query($connect, $authentif) or die("Erreur, selection donnees echouee.");
 		mysqli_stmt_execute($requete1);
 		mysqli_stmt_store_result($requete1);
 		$nombre = mysqli_stmt_num_rows($requete1);
 		if($nombre == 0)
 		{
 			$reponse = ""; 			
 		}
 		else
 		{
 			while($resultat = mysqli_fetch_row($requete2))
			{
				$lenom = $resultat[1];
				$lePrenom = $resultat[2];
			}
			
 			$reponse = $lenom . " " . $lePrenom;
 		}

 		CloseCon($connect);
 		return $reponse;
 	}

 	function authentifyun($mcode)
 	{
 		$reponse = "";
 		$connect = OpenCon();
 		$authentif = "SELECT * FROM membre WHERE Code LIKE '" . $mcode . "'; ";
 		$requete1 = mysqli_prepare($connect, $authentif) or die("Erreur, selection donnees echouee.");
 		$requete2 = mysqli_query($connect, $authentif) or die("Erreur, selection donnees echouee.");
 		mysqli_stmt_execute($requete1);
 		mysqli_stmt_store_result($requete1);
 		$nombre = mysqli_stmt_num_rows($requete1);
 		if($nombre == 0)
 		{
 			$reponse = ""; 			
 		}
 		else
 		{
 			while($resultat = mysqli_fetch_row($requete2))
			{
				$lecode = $resultat[0];
			}
			
 			$reponse = $lecode;
 		}

 		CloseCon($connect);
 		return $reponse;
 	}

 	function testStatut($mcode, $mpassword)
 	{
 		$connect = OpenCon();
 		$authentif = "SELECT * FROM membre WHERE Code LIKE '" . $mcode . "' AND password LIKE '" . $mpassword . "'; ";
 		$requete = mysqli_query($connect, $authentif) or die("Erreur, selection donnees echouee.");
 		while($resultat = mysqli_fetch_row($requete))
		{
			$lestatut = $resultat[3];
		}
 		CloseCon($connect);
 		return $lestatut;
 	}

 	function adminMembre($statut)
 	{
		switch($statut)
		{
			case 'admin':
				//header("Location: Pages/indexadmin.php");
				$statut = "";
				echo "<script>window.location.href='Pages/indexadmin.php' </script>";
			break;
			case 'membre':
				//header("Location: Pages/indexclient.php");
				echo "<script>window.location.href='Pages/indexclient.php' </script>";
			break;	
		}
 	}

 	function afficherEquipement()
 	{
 		$connect = OpenCon();
		$requete = mysqli_query($connect, "SELECT * FROM materiel;") or die("Erreur, selection donnees echouee.");
 		while($resultat = mysqli_fetch_row($requete))
		{
			$leCode = $resultat[0];
			$leNom = $resultat[1];
			$decription = $resultat[2];
			$dispo = $resultat[4];
			echo "<tr>
					<td colspan= \"8\"> $leCode </td> 
					<td colspan= \"8\"> $leNom </td> 
					<td colspan= \"8\"> $decription </td> 
					<td colspan= \"8\"> $dispo </td> 
				</tr>";
		}
 	}

 	function ajouterEquipement($no, $nom, $desctip, $prix)
 	{
 		$connect = OpenCon();
 		//echo 'ajout effectuer';
 		$sourcePhoto = $no . ".jpg";
 		$dispo = "disponible";
 		$connect = OpenCon(); 		
 		$inserer = "INSERT INTO materiel (Noserie, nom, description, prix, disponibilite, photo) VALUES (\"" . $no . "\", \"" . $nom . "\", \"" . $desctip . "\", \"" . $prix . "\", \"" . $dispo . "\", \"" . $sourcePhoto . "\" );";
 		$requete = mysqli_query($connect, $inserer) or die("Erreur, insertion echouee."); 

 		if ($requete == true) {
    		echo "Enregistrement Ajouté";
		}

 		CloseCon($connect);

 	}

 	function nouvelEmprunt($codeClieent, $codeMat, $dateLoc, $dateRetour, $prixoc)          
 	{ 
 		$connect = OpenCon(); 			
		$inserer = "INSERT INTO location(Code, Noserie, datelocation, dateretour, prixlocation) VALUES (\"" . $codeClieent . "\", \"" . $codeMat . "\", \"" . $dateLoc . "\", \"" . $dateRetour . "\", \"" . $prixoc . "\");";
		$requete1 = mysqli_query($connect, $inserer) or die("Erreur, insertion echouee.");

		$dispo = "UPDATE materiel SET disponibilite = 'reserve' WHERE Noserie like \"" . $codeMat . "\"; ";
		$requete2 = mysqli_query($connect, $dispo) or die("Erreur, selection donnees echouee."); 

		if ($requete1 == true & $requete2 == true) {
			echo "Location effectuée";
		}	
		CloseCon($connect);
 	}

 	function faireRetour($equipement, $client)
 	{
 		echo 'Effectuer Retour' . $equipement . ' ' . $client;
 		$equipement = trim($equipement);
 		$client = trim($client);
 		$connect = OpenCon();
		$effacer = "DELETE FROM location WHERE Noserie LIKE \"" . $equipement . "\" AND Code LIKE \"" . $client ."\";";
		$requete1 = mysqli_query($connect, $effacer) or die("Erreur, selection donnees echouee.");
 		
 		$dispo = "UPDATE materiel SET disponibilite = 'disponible' WHERE Noserie = \"" . $equipement . "\"; ";
		$requete2 = mysqli_query($connect, $dispo) or die("Erreur, selection donnees echouee.");

		if ($requete1 == true & $requete2 == true) {
			echo "Retour effectuée";
		}	
		CloseCon($connect);
 	}

 	function copyName($affiche)
 	{
 		$connect = OpenCon();
 		$requete = mysqli_query($connect, "SELECT * FROM membre WHERE statut LIKE 'membre';") or die("Erreur, selection donnees echouee.");
 		while($resultat = mysqli_fetch_row($requete))
		{
			$leNom = $resultat[0];
				if($affiche == $leNom) {
					$selected = "selected";
				}
				else
				{
					$selected = "";
				}
				echo  "<option $selected  value = '$leNom'>$leNom</option>";
		}
		CloseCon($connect);
 	}

 	function choixNom($choisi)
 	{
 		$connect = OpenCon();
 		$requeteNom = "SELECT * FROM membre WHERE Code = \"" . $choisi . "\";";
 		$requete = mysqli_query($connect, $requeteNom) or die("Erreur, selection nom echouee.");
 		while ($donnees = mysqli_fetch_assoc($requete))//($donnees = $requete->fetch($requete))
		{
    		return $donnees['nom'];
		}
 		CloseCon($connect);
 	}

//------------------------- ------------------------------------------------//
	function choixPrenom($choisi)
 	{
 		$connect = OpenCon();
 		$requetePrenom = "SELECT * FROM membre WHERE Code = \"" . $choisi . "\" ;";
 		$requete = mysqli_query($connect, $requetePrenom) or die("Erreur, selection prenom echouee.");
 		while ($donnees = mysqli_fetch_row($requete))
		{
    		return $donnees[2]; 
		}

 		CloseCon($connect);
 	}

 	function choixPw($choisi)
 	{
 		$connect = OpenCon();
 		$requetePrenom = "SELECT * FROM membre WHERE Code = \"" . $choisi . "\" ;";
 		$requete = mysqli_query($connect, $requetePrenom) or die("Erreur, selection prenom echouee.");
 		while ($donnees = mysqli_fetch_row($requete))
		{
    		return $donnees[3]; 
		}

 		CloseCon($connect);
 	}

 	function displayAllData()
	{
		echo "<center> <h3> LISTE DES MEMBRES </h3> </center> <br> 
					<table class = \"lesMembres\" id = \"listeMembres\">
						<tr>
							<th>Codes</th>
							<th>Noms</th>
							<th>Prenoms</th>
						</tr>
					";
		$connect = OpenCon();
		$requete = mysqli_query($connect, "SELECT * FROM membre WHERE statut LIKE 'membre';") or die("Erreur, selection donnees echouee.");
 		while($resultat = mysqli_fetch_row($requete))
		{
			$leCode = $resultat[0];
			$leNom = $resultat[1];
			$lePrenom = $resultat[2];
			echo "<tr>
					<td> $leCode </td> 
					<td> $leNom </td> 
					<td> $lePrenom </td> 
				</tr>";
		}

		echo "</table>";
		CloseCon($connect);
	}

function membreEquipement($username)
{
	$connect = OpenCon();
	$user = "SELECT * FROM location WHERE Code LIKE '" . $username . "'; ";
		$requete = mysqli_query($connect, $user) or die("Erreur, selection donnees echouee.");
 		while($resultat = mysqli_fetch_row($requete))
		{
			$noSerie = $resultat[1];
			$dateLoc = $resultat[2];
			$dateRetour = $resultat[3];
			echo "	<tr>
					<td colspan=\"8\"> $noSerie </td> 
					<td colspan=\"8\"> $dateLoc </td> 
					<td colspan=\"8\"> $dateRetour </td> 
					</tr>
				";
		}
		CloseCon($connect);
}


function copyMateriel($affiche)
{
	$connect = OpenCon();
	$requete = mysqli_query($connect, "SELECT * FROM materiel WHERE disponibilite LIKE 'disponible';") or die("Erreur, selection donnees echouee.");
	while($resultat = mysqli_fetch_row($requete))
	{
		$leNom = $resultat[0];
		if($affiche == $leNom) {
			$selected = "selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option selected value= \"" . $leNom . "\">" . $leNom . "</option>" . "<br>";
	}
CloseCon($connect);
}

function EquipementClient($username)
{
	$connect = OpenCon();
	$user = "SELECT * FROM location WHERE Code LIKE '" . $username . "'; ";
		$requete = mysqli_query($connect, $user) or die("Erreur, selection donnees echouee.");
 		while($resultat = mysqli_fetch_row($requete))
		{
			$noSerie = $resultat[1];
			echo "<option value = '$noSerie'>$noSerie</option>";			
		}
		CloseCon($connect);
}

function insertion($unNom, $unPrenom, $password) 
 	{
 		$unNom = trim($unNom);
 		$unPrenom = trim($unPrenom);
 		$password = trim($password);
 		echo $password;
 		$statut = "membre";
 		if ($unNom == "" || $unPrenom == "" || $password == "" || ($unNom == "" & $unPrenom == "" & $password == ""))
 		{
 			echo "Entrée(s) manquante(s), veuillez recommencer.";
 		}
 		else
 		{
	 		$uncode = substr($unNom, 0, 3) . substr($unPrenom, 0, 2);
	 		$connect = OpenCon(); 		
	 		$inserer = "INSERT INTO membre(Code, nom, prenom, statut, password) VALUES(\"" . $uncode . "\", \"" . $unNom . "\", \"" . $unPrenom . "\", \"" . $statut . "\", \"" . $password . "\");";
	 		$requete = mysqli_query($connect, $inserer) or die("Erreur, insertion echouee."); 

	 		if ($requete == true) {
	    		echo "Enregistrement Ajouté";
			}

	 		CloseCon($connect);
	 	}
 	}

 	function miseAJour($unCode, $unNom, $unPrenom, $password)
 	{
 		$unNom = trim($unNom);
 		$unPrenom = trim($unPrenom);
 		$password = trim($password);
 		if ($unNom == "" || $unPrenom == "" || $password == "" || ($unNom == "" & $unPrenom == "" & $password == ""))
 		{
 			echo "Entrée(s) manquante(s), veuillez recommencer.";
 		}
 		else
 		{
	 		$connect = OpenCon();
	 		$misAJour = "UPDATE membre SET nom = \"" . $unNom . "\", prenom = \"" . $unPrenom . "\", password = \"" . $password . "\" WHERE Code like \"" . $unCode . "\"; ";
	 		$requete = mysqli_query($connect, $misAJour) or die("Erreur, Mise a jour echouee."); 
	 		if ($requete == true) {
	    		echo "Enregistrement Mis à jour!";
			}
	 		CloseCon($connect);
 		}
 	}

 	function supression($unCode)
 	{
 		$connect = OpenCon();
 		$effacer = "DELETE FROM membre WHERE Code LIKE '" . $unCode . "'; "; 		
 		$requete = mysqli_query($connect, $effacer) or die("Erreur, suppression echouee.");
 		CloseCon($connect);
 	}

	function gestionDate()
	{
		$month = date('m');
		$day = date('d');
		$year = date('Y');

		$today = $year . '-' . $month . '-' . $day;
		return $today; 

	}

	function prixMateriel($noserie)
	{
		$connect = OpenCon();
		$requete = mysqli_query($connect, "SELECT * FROM materiel WHERE Noserie LIKE '" . $noserie . "';") or die("Erreur, selection donnees echouee.");
		while($resultat = mysqli_fetch_row($requete))
		{
			$lePrix = $resultat[3];
			
		}
		
		CloseCon($connect);
	}


?>

