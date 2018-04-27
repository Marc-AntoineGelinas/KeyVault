/*
Validation du nom du classeur à l'aide du ajax. Le nom est envoyé à validationClasseur.ajax.php qui valide le nom.
informerUsager gère la réponse de la validation et affiche le résultat à l'utilisateur
 */
function validationNomClasseur(nom) {
    if (nom.length >= 0) {
        var url = './Ajax/validationClasseur.ajax.php';
        var parametres = "nom="+nom;
        objetRequete = new XMLHttpRequest();
        if (!objetRequete) {
            informerErreur('Status erreur : '+ objetRequete.status);
            return false;
        }
        objetRequete.onreadystatechange = function () {
            recupererReponse(objetRequete);
        };
        objetRequete.open('POST', url, true);
        objetRequete.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        objetRequete.send(parametres);
    }
    else {
        informerUsager("Entrer un nom");
    }

}

function recupererReponse(objetRequete) {
    if (objetRequete.readyState == 4) {
        if (objetRequete.status == 200) {
            informerUsager(objetRequete.responseText);
        } else {
            informerErreur('Status erreur: '+ objetRequete.status);
        }
    }
}

/*
Gère la réponse de la validation php. Affiche à l'utilisateur les erreurs rencontrés. Si le nom est
valide et disponible, un champ caché est configurer pour la validation de la création.
 */
function informerUsager(reponseValide) {
    var message = document.getElementById("vNom");
    var hNom = document.getElementById("hNom");
    var textbox = document.getElementById("nom");

    if (reponseValide == "ok"){
        textbox.setAttribute("style", "border-color : green");
        message.setAttribute("style", "color : green");
        message.innerHTML="Le nom de classeur est valide";
        hNom.value = true;
        confirmationCreationClasseur();
    }
    else{
        textbox.setAttribute("style", "border-color : red");
        message.setAttribute("style", "color : red");
        message.innerHTML = reponseValide;
        hNom.value = false;
    }
}

/*
Si une erreur en rencontré durant la validation, le message d'erreur est retourné à l'utilisateur
 */
function informerErreur(message){
    var erreur = document.getElementById("vNom");
    var hNom = document.getElementById("hNom");

    if (message !== null){
        erreur.innerHTML=message;
        hNom.value = false;
        message.setAttribute("style", "color : red");
        erreur.setAttribute("style","color:red ;");
    } else {
        erreur.removeAttribute("style");
        hNom.value = false;
        erreur.innerHTML = "Vous pouvez créer votre classeur.";
    }




}