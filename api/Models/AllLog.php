<?php

require_once("./Config.php");

class Log
{
    public $response = array();

    public static function Enregistrer_Log($Id_adm, $psw)
    {
        $data = get_connection();
        $response = array();

        // Insérer les données dans la table all_log
        if ($data->query("INSERT INTO all_log (Id_adm, psw) VALUES ('$Id_adm', '$psw')")) {
            $response["message"] = "Enregistrement réussi";
            $response["Dernier_Enregistrement"] = self::get_last();
            return $response;
        } else {
            $response["message"] = "Échec d'enregistrement";
            return $response;
        }
    }

    public static function Supprimer_Log($id_psw)
    {
        $data = get_connection();
        $response = array();
        if ($data->query("DELETE FROM all_log WHERE id_psw = '$id_psw'")) {
            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de suppression";
            return $response;
        }
    }

    public static function Modifier_Log($id_psw, $Id_adm, $psw)
    {
        $data = get_connection();
        $response = array();

        if ($data->query("UPDATE all_log SET Id_adm='$Id_adm', psw='$psw' WHERE id_psw = '$id_psw'")) {
            $response["message"] = "Modification réussie";
            return $response;
        } else {
            $response["message"] = "Échec de modification";
            return $response;
        }
    }

    public static function get_all_Log()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM users")->fetchAll();
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
        $donnees = $data->query("SELECT * FROM all_log ORDER BY id_psw DESC LIMIT 1")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }
}
