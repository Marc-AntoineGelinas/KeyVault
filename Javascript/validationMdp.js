/*
Valide que le mot de passe est d'un minimum de 10 et maximum de 32 caractères.
 */
function validerMinMax(mdp) {
    var vMinMax = document.getElementById("vMinMax");

    if (mdp.length === 1 && event.keyCode === 8){
        vMinMax.removeAttribute("style");
        return false;
    }

    if (mdp.length != 0) {
        if (mdp.length >= 10 && mdp.length <= 32) {
            vMinMax.setAttribute("style", "color : green");
            return true;
        }
        else {
            vMinMax.setAttribute("style", "color : red");
            return false;
        }
    }
    else {
        vMinMax.removeAttribute("style");
        return false;
    }


}

/*
Valide que le mot de passe contient au moins 1 caractère lowercase
 */
function validerLowercase(mdp) {
    var vLowercase = document.getElementById("vLowercase");

    if (mdp.length === 1 && event.keyCode === 8){
        vLowercase.removeAttribute("style");
        return false;
    }

    if (mdp.length != 0) {
        for (var x = 0; x < mdp.length; x++) {
            if (mdp[x] === mdp[x].toLowerCase()) {
                vLowercase.setAttribute("style", "color : green");
                return true;
            } else
                vLowercase.setAttribute("style", "color : red");
        }
        return false;
    }
    else {
        vLowercase.removeAttribute("style");
        return false;
    }
}


/*
Valide que le mot de passe contient au moins 1 caractère uppercase
 */
function validerUppercase(mdp) {
    var vUppercase = document.getElementById("vUppercase");


    if (mdp.length === 1 && event.keyCode === 8){
        vUppercase.removeAttribute("style");
        return false;
    }

    if (mdp.length != 0) {
        for (var x = 0; x < mdp.length; x++) {
            if (mdp[x] === mdp[x].toUpperCase()) {
                vUppercase.setAttribute("style", "color : green");
                return true;
            }
            else
                vUppercase.setAttribute("style", "color : red");
        }
        return false;
    }
    else {
        vUppercase.removeAttribute("style");
        return false;
    }
}


/*
Valide que le mot de passe contient au moins 1 caractère numérique (chiffre)
 */
function validerNumerique(mdp) {
    var vNumerique = document.getElementById("vNumerique");
    var num = /[1234567890]+/;

    if (mdp.length === 1 && event.keyCode === 8){
        vNumerique.removeAttribute("style");
        return false;
    }

    if (mdp.length != 0) {
            if (num.test(mdp)) {
                vNumerique.setAttribute("style", "color : green");
                return true;
            } else {
                vNumerique.setAttribute("style", "color : red");
                return false;
            }
    }
    else {
        vNumerique.removeAttribute("style");
        return false;
    }
}

/*
Valide que le mot de passe contient au moins 1 caractère spécial (!@#$%&*()+-=...)
 */
function validerSpecial(mdp) {
    var vSpecial = document.getElementById("vSpecial");
    var special = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

    if (mdp.length === 1 && event.keyCode === 8){
        vSpecial.removeAttribute("style");
        return false;
    }


    if (mdp.length != 0) {
        if (special.test(mdp)) {
            vSpecial.setAttribute("style", "color : green");
            return true;
        }
        else {
            vSpecial.setAttribute("style", "color : red");
            return false;
        }
    }
    else {
        vSpecial.removeAttribute("style");
        return false;
    }
}


/*
Validation du mot de passe. Le mot de passe est valider de 5 manières différentes et doit passé toutes
les validations pour être accepter et configurer une variable caché pour la confirmation. Si une validation
n'est pas respecté, la validation est refusé.
 */
function validerMotDePasseUsager(mdp) {
    var valide = 0;


    if (validerMinMax(mdp))
        valide++

    if (validerLowercase(mdp))
        valide++

    if (validerUppercase(mdp))
        valide++

    if (validerNumerique(mdp))
        valide++

    if (validerSpecial(mdp))
        valide++


    if (valide == 5)
        return true;
    else
        return false;
}

/*
Valide que la confirmation du mot de passe est identique au mot de passe. Sinon, l'ajout du classeur n'est pas
autoriser.
 */
function validerMotDePasseClasseur(mdp) {
    var Pass2 = document.getElementById("pass2");

    if (mdp.length == 0) {
        Pass2.innerHTML = "";
        Pass2.setAttribute("disabled", "disabled");
        return true;
    } else {
        Pass2.removeAttribute("disabled");
        var valide = 0;


        if (validerMinMax(mdp))
            valide++

        if (validerLowercase(mdp))
            valide++

        if (validerUppercase(mdp))
            valide++

        if (validerNumerique(mdp))
            valide++

        if (validerSpecial(mdp))
            valide++


        if (valide == 5)
            return true;
        else
            return false;


    }

}

/*
Valide que le nom de classeur est contient au moins un caractère
*/
function validerNomClasseur(nom){
    var vNom = document.getElementById("vNom");

    if (nom.length < 1){
        vNom.setAttribute("style", "color : red");
        vNom.innerHTML = "Le nom du classeur doit contenir au moins un caractère";
        return false;
    }
    else
    {
        vNom.setAttribute("style", "color : green");
        vNom.innerHTML = "Le nom du classeur est valide";
        return true
    }
}

/*
Valide que la confirmation du mot de passe est identique au mot de passe. Sinon, la confirmation n'est pas
autoriser.
 */
function validerConfirmationCompte(mdp) {
    var vMdp = document.getElementById("Pass2");
    var vConfirmer = document.getElementById("vConfirmer");

    if (mdp.length != 0 && vMdp.value.length != 0) {
        if (vMdp.value == mdp) {
            vConfirmer.setAttribute("style", "color : green");
            return true;
        }
        else {
            vConfirmer.setAttribute("style", "color : red");
            return false;
        }
    }
    else {
        vConfirmer.removeAttribute("style");
        return true;
    }
}

/*
Valide que la confirmation du mot de passe d'un classeur
 */
function validerConfirmationClasseur(mdp) {
    var vConfirmer = document.getElementById("vConfirmer");
    var vMdp = document.getElementById("pass2");

    if (mdp.length == 0) {
        vMdp.setAttribute("disabled", "disabled");
        vMdp.value = "";
        vConfirmer.setAttribute("style", "color : green");
        return true;
    }
    else {
        vMdp.removeAttribute("disabled");
        if (vMdp.value == mdp) {
            vConfirmer.setAttribute("style", "color : green");
            return true;
        }
        else {
            vConfirmer.setAttribute("style", "color : red");
            return false;
        }
    }

}

/*
Valide que les 3 champs sont valides pour la confirmation du compte de l'usager (e-mail, mot de passe et
confirmation)
 */
function confirmationCreationCompte() {
    var hNom = document.getElementById("hEmail");
    var mdp = document.getElementById("pass");
    var boutton = document.getElementById("btnAjout");

    if (hNom.value == true && validerMotDePasseUsager(mdp.value) && validerConfirmationCompte(mdp.value)) {
        boutton.removeAttribute("disabled");
    }
    else {
        boutton.setAttribute("disabled", "disabled");
    }
}

/*
Valide la reinitialisation d'un mot de passe principal
 */
function confirmationReinitialisation() {
    var mdp = document.getElementById("pass");
    var boutton = document.getElementById("btnAjout");

    if (validerMotDePasseUsager(mdp.value) && validerConfirmationCompte(mdp.value)) {
        boutton.removeAttribute("disabled");
    }
    else {
        boutton.setAttribute("disabled", "disabled");
    }
}
/*
Valide que les 3 champs sont valides pour la création du classeur (nom, mot de passe et
confirmation)
*/
function confirmationCreationClasseur() {
    var nom = document.getElementById("nom");
    var mdp = document.getElementById("pass");
    var boutton = document.getElementById("btnAjout");

    if (validerNomClasseur(nom.value) && validerMotDePasseClasseur(mdp.value) && validerConfirmationClasseur(mdp.value)) {
        boutton.removeAttribute("disabled");
    }
    else {
        boutton.setAttribute("disabled", "disabled");
    }
}