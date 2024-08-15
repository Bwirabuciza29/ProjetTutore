<?php
require_once("./Models/CatUser.php");

//enregistrement
$retour = array();

function Enregistrer_Categorie() // Modifier le nom de la fonction pour correspondre au modèle
{
    $designation = isset($_POST["designation"]) ? $_POST["designation"] = htmlspecialchars($_POST["designation"]) : $_POST["designation"] = trim($_POST["designation"]);

    //appel model enregistrement option
    return Categorie::Enregistrer_Categorie($designation);
}

//suppression
function Supprimer_Categorie()
{
    $Id_cat  = $_POST["Id_cat"];
    return Categorie::Supprimer_Categorie($Id_cat);
}


// Modification
function Modifier_Categorie()
{
    // Ajout de logs pour le débogage
    error_log("POST data: " . print_r($_POST, true));

    if (isset($_POST["Id_cat"]) && isset($_POST["designation"])) {
        $Id_cat = htmlspecialchars(trim($_POST["Id_cat"]));
        $designation = htmlspecialchars(trim($_POST["designation"]));
        // Appel au modèle pour la modification
        return Categorie::Modifier_Categorie($Id_cat, $designation);
    } else {
        return array("message" => "Id_cat ou designation non défini(s)");
    }
}



function get_all_Categorie()
{
    return Categorie::get_all_Categorie();
}
