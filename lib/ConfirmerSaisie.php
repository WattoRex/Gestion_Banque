<?php
function getUserConfirmation($message)
{
    while (true) {
        $continuer = readline("Voulez-vous confirmer votre saisie ? (o/n) : ");

        if ($continuer === 'o' || $continuer === 'n') {
            return $continuer;
        } else {
            echo "Saisie invalide, veuillez entrer 'o' pour oui ou 'n' pour non." . PHP_EOL;
        }
    }
}

// Exemple : Utilisation de la fonction générique
// $continuer = getUserConfirmation("Voulez-vous confirmer votre saisie ?");