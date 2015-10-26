/* 
   Nom : others.css
   Créé par Léa
   Contient des fonctions javascript nécessaires au site
*/

// Autorise seulement de taper des lettres dans une text box.
function alphaOnly(e) {
  var code;
  if (!e) var e = window.event;
  if (e.keyCode) code = e.keyCode;
  else if (e.which) code = e.which;
  if ((code >= 48) && (code <= 57)) { return false; }
  return true;
}
