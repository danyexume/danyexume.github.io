<form method = "POST" action = "">
  <h3>Gestion De Locations</h3>
  <ul>
    <li class = "liensSec"><a class = "btn btn-secondary btn-lg liena" href = "indexadmin.php?lien=location&action=emprunt">Nouvel Emprunt</a></li>
    <li class = "liensSec"><a class = "btn btn-secondary btn-lg liena" href = "indexadmin.php?lien=location&action=retour">Comptes/Retours</a></li>
  </ul>
  <div align = "center">
    <?php         
      if(isset($_GET['action']))
      { 
        $action = $_GET['action'];
        include '../Pages_Backend/connexionBD.php';          
        switch($action)
        {
          case 'emprunt':
    ?>
            <div align = "center">
              <h1> Nouvel Emprunt </h1>
              <table>
                <tr>
                  <td>Code Client </td>
                  <td colspan="8">
                    <select name = "choixClient">
                      <?php
                        copyName($_POST["choixClient"]);
                      ?>
                    </select>
                  </td>
                </tr>
                <?php
                  if(isset($_POST['louerMat']))
                  {
                     nouvelEmprunt($_POST["choixClient"], $_POST["choixMat"], $_POST["dateloc"], $_POST["dateret"], $_POST["prixLocation"]);
                  } 
              ?>
                <tr>
                  <td>Materiel </td>
                  <td colspan="8">
                    <select name = "choixMat">
                      <?php 
                        copyMateriel($_POST["choixMat"]);
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Date Location </td>
                  <td><input type="date" name="dateloc" value="<?php echo gestionDate(); ?>"></td>
                <tr>
                  <tr>
                  <td>Date Retour </td>
                  <td><input type="date" name="dateret" value="2018-12-31"></td>
                </tr>
                <tr> 
                  <td>Prix Location</td>
                  <td><input type="number" step="0.01" name = "prixLocation" value = "0.01" /></td>
                </tr>
                <tr>
                  <td><input type = "submit" name = "louerMat" value = "Location"/>
                </tr>                
              </table>
            </div>
    <?php
            if(isset($_POST['louerMat']))
            {
               nouvelEmprunt($_POST["choixClient"], $_POST["choixMat"], $_POST["dateloc"], $_POST["dateret"], $_POST["prixLocation"]);
            }  
            
          break;
          case 'retour':
    ?>
            <div align = "center">
              <h1> Retour </h1>
              <table>
                <tr>
                  <td>Code Client </td>
                  <td colspan="8">
                    <select name = "choixClient">
                      <?php
                        copyName($_POST["choixClient"]);
                      ?>
                    </select>
                  </td>
                  <td><input type = "submit" name = "choixCompte" value = "Compte"/></td>
                </tr>            
              </table>
            </div>
        <?php
        if(isset($_POST['remettre']))
        {
          faireRetour($_POST['choixEquipement'], $_POST['choixClient']);
        }

        if(isset($_POST['choixCompte']))
            {              
              ?>
               <table>
                <th colspan="8"> NoSerie </th>
                <th colspan="8"> DateLocation </th>
                <th colspan="8"> DateRetour</th>
                  <?php
                  membreEquipement($_POST['choixClient'])
                  ?>
                
               </table>
               <?php echo "<h3> Effectuez les retours au compte de " . $_POST['choixClient'] . "ici : </h3>" ?> 
               <table>
                <tr>
                  <td>Choisir equipement </td>
                  <td>
                    <select name = "choixEquipement">
                      <?php 
                        EquipementClient($_POST['choixClient']);
                        $CodeClient = $_POST['choixClient'];
                      ?>
                    </select>
                  </td>
                </tr>
                <tr> <td><input type = "submit" name = "remettre" value = "Remettre"/> </td></tr>
               </table>
               <?php
              } 
          break;
        }
      }
    ?>
</form>