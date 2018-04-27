/*
Validation du e-mail à l'aide du ajax. Le e-mail est envoyé à validationEmail.ajax.php qui valide le e-mail.
informerUsager gère la réponse de la validation et affiche le résultat à l'utilisateur
 */
function validationEmail(email) {
    if (email.length > 0) {
        var url = './Ajax/validationEmail.ajax.php';
        var parametres = "email="+email;
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
        informerUsager("Entrer une adresse");
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
Gère la réponse de la validation php. Affiche à l'utilisateur les erreurs rencontrés. Si le e-mail est
valide et disponible, un champ caché est configurer pour la validation de la création.
 */
function informerUsager(reponseValide) {
    var message = document.getElementById("vEmail");
    var hEmail = document.getElementById("hEmail");
    var erreur = document.getElementById("eEmail");
    var textbox = document.getElementById("email");

    if (reponseValide == "ok"){
        textbox.setAttribute("style", "border-color : green");
        message.setAttribute("style", "color : green");
        hEmail.value = true;
        erreur.innerHTML = null;
        confirmationCreationCompte();
    }
    else{
        textbox.setAttribute("style", "border-color : red");
        message.setAttribute("style", "color : red");
        hEmail.value = false;
        erreur.innerHTML = reponseValide;
        erreur.setAttribute("style", "color : red");
    }





}

/*
Si une erreur en rencontré durant la validation, le message d'erreur est retourné à l'utilisateur
 */
function informerErreur(message){
    var erreur = document.getElementById("vEmail");
    var hEmail = document.getElementById("hEmail");

    if (message !== null){
        erreur.innerHTML=message;
        hEmail.value = false;
        message.setAttribute("style", "color : red");
        erreur.setAttribute("style","color:red ;");
    } else {
        erreur.removeAttribute("style");
        hEmail.value = false;
        erreur.innerHTML = "Vous pouvez créer votre compte.";
    }




}