<?php
session_start();
include("connexion.php"); 

if(!empty($_GET['action']))
{
	switch($_GET['action'])
	{
		case 'add': 
		$requete=mysqli_query($connect, "SELECT * FROM tblproduct WHERE code = '". $_GET['code'] ."'") or die ("Erreur1 : Table inexistante");
		$nombre = mysqli_num_rows($requete);
		$code = $price = $name = "";
		if($nombre >0)
		{
			while($resultat=mysqli_fetch_row($requete))        
			{
				$code = $resultat[2];
			    $price = $resultat[4];
			    $name =  $resultat[1];
			}
		}

		$itemArray = array(
			$code => array(
				'name' => $name,
				'code' => $code,
				'quantity' => $_POST['quantity'],
				'price' => $price
			)
		);

		if(!empty($_SESSION["cart_item"]))
		{
			if(in_array($code,array_keys($_SESSION["cart_item"])))
			{
				foreach($_SESSION['cart_item'] as $k => $v)
				{
					if($_GET['code'] == $k)
					{
						$_SESSION["cart_item"][$k]["quantity"] += $_POST['quantity'];
					}
				}
			}
			else
			{
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
			}			
		}
		else
		{
			$_SESSION["cart_item"] = $itemArray;
		}
		
		print_r($_SESSION["cart_item"]);
		break;

		case 'vide':
			echo $_GET['action'];
			unset($_SESSION['cart_item']);
		break;

		case 'remove':
			foreach($_SESSION['cart_item'] as $k => $v)
			{
				if($_GET['code'] == $k)
				{
					unset($_SESSION['cart_item'][$k]);
				}
			}
		break;
	}
}

?>

<HTML>
<HEAD>
<TITLE>Panier en PHP</TITLE>
<meta charset="UTF-8">
<link href="style.css" type="text/css" rel="stylesheet" /> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel = "StyleSheet" href = "../Style/style.css" type = "text/css" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    </HEAD>
<bODYody class = "Body adminBody">
    <div class="container backContainer">
	<div class="row enteteTeccart">
          <div class = "col-sm-6">
            <ul class="nav navbar"> 
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"> ACCUEIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Pages/indexclient.php">LOCATIONS</a>
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
	<div id="shopping-cart">
        <div class="txt-heading">
        
        Panier d'achats 
        <a id = "btnEmpty" href ="panier.php?action=vide">Vider le panier</a>
        </div>
    <?php
        if(isset($_SESSION["cart_item"])){
        $item_total = 0;
    ?>	 
<table cellpadding="10" cellspacing="1">
    <tbody>
        <tr>
            <th style="text-align:left;"><strong>Nom</strong></th>
            <th style="text-align:left;"><strong>Code</strong></th>
            <th style="text-align:right;"><strong>Quantité</strong  ></th>
            <th style="text-align:right;"><strong>Prix</strong></th>
            <th style="text-align:center;"><strong>Action</strong></th>
            </tr>	
    <?php		
        foreach ($_SESSION["cart_item"] as $item){
    ?>
        <tr>
        <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
        <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
        <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
        <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["price"]; ?></td>
        <td style="text-align:center;border-bottom:#F0F0F0 1px solid;">
        	<a class = "btnRemoveAction" href = "panier.php?action=remove&code=<?php echo $code; ?>">Retirer</a>  
     	</td>
        </tr>
        <?php
        	$item_total += $item["price"] * $item["quantity"];
		}
		?>

        <tr>
        <td colspan="5" align=right><strong>TOTAL: <?php echo $item_total; ?></strong></td>
        </tr>
    </tbody>
</table>		
  <?php
}
?>
</div>


<div  id="product-grid">
	<div class="txt-heading">Produits</div>
     
	<?php	
    	$requete=mysqli_query($connect, "SELECT * FROM tblproduct ORDER BY id ASC") or die ("Erreur1 : Table inexistante");
    	$nombre = mysqli_num_rows($requete);
    	if($nombre >0)
		{
        	while($resultat=mysqli_fetch_row($requete))        
        	{
				$code = $resultat[2];
			    $img= $resultat[3];
			    $price = $resultat[4];
			    $name =  $resultat[1];              
    ?>
		<div class="product-item">
			<form method="post" action="panier.php?action=add&code=<?php echo $code; ?>">
			<div class="product-image">
            <img src="<?php echo $img; ?>"></div>
			<div><strong><?php echo $name; ?></strong></div>
			<div class="product-price"><?php echo "$".$price; ?></div>
			<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" name = "ajout" value="Ajout au panier" class="btnAddAction" /></div>
                  
			</form>
              
		</div>
	<?php
		}
	}
	?>
</div>
</div>
</BODY>
</HTML>