<table>
	<tbody>
		<tr>
                        
			<td>Code</td><td><select name = "codeClient"><?php copyName($_POST["codeClient"]);?> </select></td>
		</tr>
		<tr>
            <td>Matériel</td><td><select name = "materiel"> <?php copyMateriel($_POST["materiel"]); ?></select></td>
		</tr>
		<tr>
			<td>Date Location</td><td><input type="date" name="dateLoc" value="2018-11-24"></td>
		</tr>
		<tr>
			<td>Date Retour</td><td><input type="date" name="dateRet" value="2018-11-24"></td>
		</tr>
		<tr> 
			<td><input type="number" step="0.01" name = "prixLocation" value = "0.00" /></td>
		</tr>
		<tr> 
			<td><input type = "submit" name = "subLocation" value = "Location" /></td>
		</tr>
	</tbody>
</table>

<?php
if(isset($_POST["subLocation"]))
{
	nouvelEmprunt($_POST["codeClient"], $_POST["materiel"], $_POST["dateLoc"], $_POST["dateRet"], $_POST["prixLocation"]);
}
?>