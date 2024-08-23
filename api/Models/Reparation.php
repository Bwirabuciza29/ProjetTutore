<?php

require_once("./Config.php");

class Reparation
{
    public $response = array();

    public static function Enregistrer_Reparation($idAgent, $idVehicule, $panne, $dateRep, $duree)
    {
        $data = get_connection();
        $response = array();

        // Vérifier que l'agent est bien un mécanicien
        $agentCheck = $data->query("SELECT * FROM agent WHERE id = '$idAgent' AND category = 'Mécanicien'")->fetch();
        if (!$agentCheck) {
            $response["message"] = "L'agent spécifié n'est pas un mécanicien.";
            return $response;
        }

        if ($data->query("INSERT INTO reparation (idAgent, idVehicule, panne, dateRep, duree) 
                          VALUES ('$idAgent', '$idVehicule', '$panne', '$dateRep', '$duree')")) {
            $response["message"] = "Enregistrement réussi";
            $response["Dernier_Enregistrement"] = self::get_last();
            return $response;
        } else {
            $response["message"] = "Échec d'enregistrement";
            return $response;
        }
    }

    public static function Supprimer_Reparation($id)
    {
        $data = get_connection();
        $response = array();
        if ($data->query("DELETE FROM reparation WHERE id = '$id'")) {
            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de suppression";
            return $response;
        }
    }

    public static function Modifier_Reparation($id, $idAgent, $idVehicule, $panne, $dateRep, $duree)
    {
        $data = get_connection();
        $response = array();

        // Vérifier que l'agent est bien un mécanicien
        $agentCheck = $data->query("SELECT * FROM agent WHERE id = '$idAgent' AND category = 'Mécanicien'")->fetch();
        if (!$agentCheck) {
            $response["message"] = "L'agent spécifié n'est pas un mécanicien.";
            return $response;
        }

        if ($data->query("UPDATE reparation SET idAgent='$idAgent', idVehicule='$idVehicule', panne='$panne', dateRep='$dateRep', duree='$duree' WHERE id = '$id'")) {
            $response["message"] = "Modification réussie";
            return $response;
        } else {
            $response["message"] = "Échec de modification";
            return $response;
        }
    }

    public static function get_all_Reparations()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM allrep")->fetchAll();
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
        $donnees = $data->query("SELECT * FROM reparation ORDER BY id DESC LIMIT 1")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }
}
