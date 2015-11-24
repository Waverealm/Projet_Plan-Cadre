/* 
   Nom : js_global.js
   Créé par Léa
   Contient des fonctions javascript nécessaires au site.
*/

// Fonction : alphaOnly()
// Fait par Léa Kelly
// Autorise seulement de taper des lettres dans une text box.
function alphaOnly(e) {
  var code;
  if (!e) var e = window.event;
  if (e.keyCode) code = e.keyCode;
  else if (e.which) code = e.which;
  if (code < 65) { return false; }
  else if ((code >= 91) && (code <= 96)) { return false; }
  else if ((code >= 123) && (code <= 126)) { return false; }
  return true;
}


// Fonction : alphaOnly()
// Fait par Antoine Latendresse
// Filtre propre au code du cours.
function filterClassCode(e) {
  var code;
  if (!e) var e = window.event;
  if (e.keyCode) code = e.keyCode;
  else if (e.which) code = e.which;
  if (code < 45) { return false; }
  else if ((code >= 46) && (code <= 47)) { return false; }
  else if ((code >= 58) && (code <= 64)) { return false; }
  else if ((code >= 91) && (code <= 96)) { return false; }
  else if ((code >= 123) && (code <= 126)) { return false; }
  return true;
}

// Fonction : showSelectedInstruction()
// Fait par Léa Kelly
// Selon l'instruction sélectionnée, affecte l'énoncé et la description correspondants dans les text box.
// On fait référence au contenu du tableau placé en début de page.
function showSelectedInstruction(selected) {
  if(selected == "1") 
  {
    document.getElementById("enonce").value = document.getElementById("1_enonce").innerHTML;
    document.getElementById("description").value = document.getElementById("1_description").innerHTML;
  }

    if(selected == "2") 
  {
    document.getElementById("enonce").value = document.getElementById("2_enonce").innerHTML;
    document.getElementById("description").value = document.getElementById("2_description").innerHTML;
  }

    if(selected == "3") 
  {
    document.getElementById("enonce").value = document.getElementById("3_enonce").innerHTML;
    document.getElementById("description").value = document.getElementById("3_description").innerHTML;
  }

    if(selected == "4") 
  {
    document.getElementById("enonce").value = document.getElementById("4_enonce").innerHTML;
    document.getElementById("description").value = document.getElementById("4_description").innerHTML;
  }
}


// Fonction : showSelectedInstruction()
// Fait par Léa Kelly
// Fait en sorte de charger l'énoncé et la description de la première consigne lors du chargement de la page.
// Pour l'instant c'est "hard coded". J'ai essayé de réutiliser la fonction showSelectedInstruction,
// mais window.load ne semble pas vouloir exécuter une fonction qui prend des paramètres.
// À voir s'il serait possible d'arranger ce problème ou de trouver une alternative.
function loadInstruction() {
    document.getElementById("enonce").value = document.getElementById("1_enonce").innerHTML;
    document.getElementById("description").value = document.getElementById("1_description").innerHTML;
}

/*
    arrayFilter(search, list)
    search : est une chaine de charactère qui va servir de filtre
    list : est une référence à un objet de type select (ComboBox)

    La liste est réorganisée pour que les éléments qui contiennent le filtre se retrouvent
    en haut de la liste.
	Il est suggérer de l'utiliser pour un select avec un input
    exemple : <input type="text" name="uneZoneTexte" onchange="arrayFilter(this.value, this.form.CBX_nom)"
	onKeyUp ="arrayFilter(this.value, this.form.CBX_nom)">
    <select name="selectName">
    <option></option>
    <option value="valeurVoulue" ><*option>

	///////////////////////////////////////////////////////////////////////////
    // Tiré de : http://evolt.org/node/55035/
    // Adapté par : Simon Roy
    // Auteur: Justin Whitford
  	// Source: www.evolt.org
   	///////////////////////////////////////////////////////////////////////////
*/
function arrayFilter(search, list){

    // si un backup de la liste n'existe pas on en fait un maintenant
	if (!list.backUp){

		list.backUp = new Array();

		for (n=0;n<list.length;n++){

			list.backUp[list.backUp.length] = new Array(list[n].value, list[n].text);
		}
	}

	match = new Array();

	nomatch = new Array();

	for (n=0;n<list.backUp.length;n++){

		if(list.backUp[n][1].toLowerCase().indexOf(search.toLowerCase())!=-1){

			// ajouter l'élément à la fin de l'array
			match[match.length] = new Array(list.backUp[n][0], list.backUp[n][1]);

		}else{

			nomatch[nomatch.length] = new Array(list.backUp[n][0], list.backUp[n][1]);
		}
	}

	// ajouter les éléments qui contiennent le filtre en premier
	for (n=0;n<match.length;n++){

		list[n].value = match[n][0];

		list[n].text = match[n][1];
	}

	// ajouter les éléments qui ne contiennent pas le filtre après ceux qui le contiennent
	for (n=0;n<nomatch.length;n++){

		list[n+match.length].value = nomatch[n][0];

		list[n+match.length].text = nomatch[n][1];
	}

	//pour qu'on voit immédiatement que la liste a été modifiée et que le filtre a été utilisé
	list.selectedIndex=0;
}


			