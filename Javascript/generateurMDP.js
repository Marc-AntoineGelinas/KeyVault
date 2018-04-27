//Generateur de mot de passe aléatoire.
function generateur(){
    var nombre = document.getElementById("nombre").value;
    var lowercase = document.getElementById("lowercase");
    var uppercase = document.getElementById("uppercase");
    var chiffre = document.getElementById("chiffres");
    var special = document.getElementById("special");
    var appercu = document.getElementById("appercu");

    if (validation(lowercase, uppercase, chiffre, special)) {


        var characteres = conditions(lowercase, uppercase, chiffre, special);
        var nombre = longueur(nombre);
        var random = null;
        var mdp = "";
        var x;
        var type;

        for (x = 0; x < nombre; x++) {
            random = Math.floor(Math.random() * characteres.length);
            type = characteres[random];
            random = Math.floor(Math.random() * type.length);
            mdp += type[random];
        }
        appercu.value = mdp;
    }
}

//Valide qu'au moins 2 selections sonts cochées.
function validation(lowercase, uppercase, chiffre, special){
    var valide = 0;
    var erreur = document.getElementById("eGenerateur");
    if (lowercase.checked == true){
        valide += 1;
    }if (uppercase.checked == true){
        valide += 1;
    }if (chiffre.checked == true){
        valide += 1;
    }if (special.checked == true){
        valide += 1;
    }
    if (valide >=2){
        erreur.innerHTML = null;

        return true;
    }
    else
    {
        erreur.innerHTML = "Vous devez cocher au moins deux selections pour le mot de passe";
        return false;
    }
}

//Defini les caractères pour le générateur
function conditions(pLowercase, pUppercase, pChiffre, pSpecial) {
    var characteres = Array();
    var lowercase = "abcdefghijklmnopqrstuvwxyz";
    var uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var chiffre = "1234567890";
    var special = "!@#$%?&*()[]{}.,/|\\";
    var x=0;

    if (pLowercase.checked == true) {
        characteres[x] = "";
        characteres[x] += lowercase;
        x++;
    }
    if (pUppercase.checked == true) {
        characteres[x] = "";
        characteres[x] += uppercase;
        x++;
    }
    if (pChiffre.checked == true) {
        characteres[x] = "";
        characteres[x] += chiffre;
        x++;
    }
    if (pSpecial.checked == true) {
        characteres[x] = "";
        characteres[x] += special;
        x++;
    }
    return characteres;
}

//Valide la longueur du mot de passe
function longueur(nombre) {
    if (nombre < 10 || parseInt(nombre) == NaN){
        nombre = 10;
    }
    if (nombre > 32) {
        nombre = 32
    }
    return nombre;
}