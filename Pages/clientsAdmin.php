

<head>
	<link rel = "stylesheet" href = "../Style/style.css" type = text/css /> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<form method = "POST" action = "">
   <div>
   	  <table class = "lesMembres">
   		<tbody class = "tablebody">
			<tr>
				<?php 
					include '../Pages_Backend/connexionBD.php'; 
					$Val = "Affiche";
		 			$affiche = "";
					if (isset($_POST[$Val]))
					{
						$firstname = $lastname = $passwrd = "";
						$choix = "choixMembre";
						
						$affiche = ($_POST[$choix]);
						$firstname = choixNom($affiche);
						$lastname = choixPrenom($affiche);
						$passwrd = choixPw($affiche);
					}

					else
					{
						$firstname = $lastname = $passwrd = "";
					}	
				?>					
				<td>
					<select name = "choixMembre" id = "choixMembre">
						<?php  							
							copyName($affiche);
						?>
					</select>												
				</td>
				
				<td><input class="btn btn-secondary" type = "submit" name = "Affiche" value = "Afficher" /></td>	
				<td><input class="btn btn-secondary" type = "button" name = "reset" value = "Reset" onclick = "resetdel()" /></td>					
			</tr> 
			<tr>
				<td colspan="8"><input class = "client_input_txt" type = "text" id = "nom" name = "nom" placeholder = "Nom..." value = "<?php echo $firstname; ?>" /></td>
			</tr>
			<tr>
				<td colspan="8"><input class = "client_input_txt" type = "text" id = "prenom" name = "prenom" placeholder = "Prénom..." value = "<?php echo $lastname; ?>" /></td>
			</tr>
			<tr>
				<td colspan="8"><input class = "client_input_txt" type = "password" id = "passwd" name = "passwd" placeholder = "Mot de passe..." value = "<?php echo $passwrd; ?>" /></td>
			</tr>
			<tr>					
				<td><input class="btn btn-secondary" type = "submit" name = "lien" value = "Ajouter"/></td>
				<td><input class="btn btn-secondary" type = "submit" name = "lien" value = "Modifier"/></td>
				<td><input class="btn btn-secondary" type = "submit" name = "lien" value = "Supprimer"/></td>
			</tr>
			<tr>
				<td><input type = "button" name = "ajax" value = "AJAX" onclick = "RecupMembre()" /></td>
				
			</tr>
		</tbody>
	  </table>
	  <?php
	  	if (isset($_POST['lien']))
		{
			switch ($_POST['lien']) 
			{   					
				case "Ajouter":
					insertion($_POST["nom"], $_POST["prenom"], $_POST["passwd"]);      						
				break;
				case "Modifier":
					miseAJour($_POST["choixMembre"], $_POST["nom"], $_POST["prenom"], $_POST["passwd"]);
				break;
				case "Supprimer":
					supression($_POST["choixMembre"]);
				break;

				$firstname = $lastname = $passwrd = "";
			}
		}

		else
		{
			$firstname = $lastname = $passwrd = "";
		}
	  ?>
	</div>
	
	<div class = "lesMembres">
		<?php 				
			displayAllData();
		?>
	</div>
</form>
<script src = "../Script/script.js"></script>
<script src = "../Script/JavaScript.js"></script>
