
        // Author: Justin Whitford
        // Source: www.evolt.org
        // http://evolt.org/node/55035/

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