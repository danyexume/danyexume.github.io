
function RecupMembre(){
  
   var codeaffiche = document.getElementById("choixMembre").value;
   
 //$.get("../Pages_Backend/data.php?val="+ codeaffiche, function (data) {

 // var membre = JSON.parse(data);        
 //    $('#prenom').val(membre.prenom);
 //    $('#nom').val(membre.nom);
 //    $('#passwd').val(membre.mdp);

 //   });

  //alert(codeaffiche);

  //----------------------------------------------------------------------------	-----//

	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", "../Pages_Backend/data.php?val="+ codeaffiche, true);
  	xhttp.send();
  	xhttp.onload = function() {
	    if (xhttp.readyState === 4 && xhttp.status === 200) {
	     	var data = JSON.parse(xhttp.responseText);
	     	document.getElementById("prenom").value = data[1];
	     	document.getElementById("nom").value = data[0];
	     	document.getElementById("passwd").value = data[2];
    	}
  	};
}


    