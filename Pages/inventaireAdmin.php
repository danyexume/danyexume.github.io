<head>
  <meta charset = "UTF-8"/>
</head>
  <h3>Gestion Des Equipements</h3>
  <ul>
    <li class = "liensSec"><a class = "btn btn-secondary btn-lg liena" href = "indexadmin.php?lien=inventaire&action=stock">Liste des equipements</a></li>
    <li class = "liensSec"><a class = "btn btn-secondary btn-lg liena" href = "indexadmin.php?lien=inventaire&action=ajout">Ajouter des equipements</a></li>
  </ul>
  <div align = "center">
    <?php         
      if(isset($_GET['action']))
      { 
        $action = $_GET['action'];
        include '../Pages_Backend/connexionBD.php';          
        switch($action)
        {
          case 'stock':
    ?>
            <div align = "center">
              <h1> Liste des equipements </h1>
              <table> 
                  <th colspan="8">No</th>
                  <th colspan="8">Nom</th>
                  <th colspan="8">Description</th>
                  <th colspan="8">Disponibilité</th>
              
    <?php
      afficherEquipement();
    ?>
            </table>
          </div>
    <?php
          break;

          case 'ajout':
    ?>    
          <form method = "POST" action = "">
            <div align = "center">
              <h1> Ajouter un equipement </h1>
              <table>
                <tr>
                  <td>Numero de serie </td>
                  <td colspan="8"><input type = "text" id = "noMat" name = "noMat" placeholder = "Numero de serie..."/></td>
                </tr>
                <tr>
                  <td>Nom de L'article </td>
                  <td colspan="8"><input type = "text" id = "nomMat" name = "nomMat" placeholder = "Nom de l'acticle..."/></td>
                </tr>
                <tr>
                <td>Description </td>
                  <td colspan="8"><input type = "text" id = "descript" name = "descript" placeholder = "Description..."/></td>
                </tr>
                <td>Prix </td>
                  <td colspan="8"><input type = "text" id = "prix" name = "prix" placeholder = "Prix..."/></td>
                </tr>
                <tr>
                  <td><input type = "submit" name = "ajouMat" value = "Ajouter"/>
                </tr>                
              </table>
            </div>
          
    <?php
            if(isset($_POST['ajouMat']))
            {
              ajouterEquipement($_POST['noMat'], $_POST['nomMat'], $_POST['descript'], $_POST['prix']);
            }
          break;
        }
      }
    ?>
  </form>
