<?php

require_once("./Config.php");

class Categorie
{
    public $response = array();

    public static function Enregistrer_Categorie($designation)
    {
        $data = get_connection();
        $response = array(); // Définir $response comme un tableau
        if ($data->query("INSERT INTO cat_user (designation) VALUES ('$designation')")) {
            $response["message"] = "Enregistrement réussi";
            $response["Dernier_Enregistrement"] = self::get_last();
            return $response;
        } else {
            $response["message"] = "Échec d'enregistrement";
            return $response;
        }
    }

    public static function Supprimer_Categorie($Id_cat)
    {
        $data = get_connection();
        $response = array(); // Définir $response comme un tableau
        if ($data->query("DELETE FROM cat_user WHERE Id_cat = '$Id_cat'")) {
            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de suppression";
            return $response;
        }
    }

    public static function Modifier_Categorie($Id_cat, $designation)
    {
        $data = get_connection();
        $response = array(); // Définir $response comme un tableau
        if ($data->query("UPDATE cat_user SET designation = '$designation' WHERE Id_cat = '$Id_cat'")) {
            $response["message"] = "Modification réussie";
            return $response;
        } else {
            $response["message"] = "Échec de modification";
            return $response;
        }
    }

    public static function get_all_Categorie()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM cat_user ORDER BY Id_cat DESC")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        } else {
            $response["message"] = "Aucune donnée disponible";
            return $response;
        }
    }

    public static function get_last()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM cat_user ORDER BY Id_cat DESC")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }
}
