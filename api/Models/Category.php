<?php

require_once("./Config.php");

class Category
{
    public $response = array();

    public static function Enregistrer_Category($designation)
    {
        $data = get_connection();
        $response = array();

        if ($data->query("INSERT INTO category (designation) VALUES ('$designation')")) {
            $response["message"] = "Enregistrement réussi";
            $response["Dernier_Enregistrement"] = self::get_last();
            return $response;
        } else {
            $response["message"] = "Échec d'enregistrement";
            return $response;
        }
    }

    public static function Supprimer_Category($id)
    {
        $data = get_connection();
        $response = array();
        if ($data->query("DELETE FROM category WHERE id = '$id'")) {
            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de suppression";
            return $response;
        }
    }

    public static function Modifier_Category($id, $designation)
    {
        $data = get_connection();
        $response = array();
        if ($data->query("UPDATE category SET designation='$designation' WHERE id = '$id'")) {
            $response["message"] = "Modification réussie";
            return $response;
        } else {
            $response["message"] = "Échec de modification";
            return $response;
        }
    }

    public static function get_all_Category()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM category ORDER BY id DESC")->fetchAll();
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
        $donnees = $data->query("SELECT * FROM category ORDER BY id DESC LIMIT 1")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }
}
