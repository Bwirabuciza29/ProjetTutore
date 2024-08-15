<?php

require_once("./Config.php");

class Vehicule
{
    public $response = array();

    public static function Enregistrer_Vehicule($idAgent, $designation, $marque, $numP, $category, $type_carburant)
    {
        $data = get_connection();
        $response = array();

        // Vérifier que l'agent est bien un chauffeur
        $agentCheck = $data->query("SELECT * FROM agent WHERE id = '$idAgent' AND category = 'Chauffeur'")->fetch();
        if (!$agentCheck) {
            $response["message"] = "L'agent spécifié n'est pas un chauffeur.";
            return $response;
        }

        if ($data->query("INSERT INTO vehicule (idAgent, designation, marque, numP, category, type_carburant) 
                          VALUES ('$idAgent', '$designation', '$marque', '$numP', '$category', '$type_carburant')")) {
            $response["message"] = "Enregistrement réussi";
            $response["Dernier_Enregistrement"] = self::get_last();
            return $response;
        } else {
            $response["message"] = "Échec d'enregistrement";
            return $response;
        }
    }

    public static function Supprimer_Vehicule($id)
    {
        $data = get_connection();
        $response = array();
        if ($data->query("DELETE FROM vehicule WHERE id = '$id'")) {
            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de suppression";
            return $response;
        }
    }

    public static function Modifier_Vehicule($id, $idAgent, $designation, $marque, $numP, $category, $type_carburant)
    {
        $data = get_connection();
        $response = array();

        // Vérifier que l'agent est bien un chauffeur
        $agentCheck = $data->query("SELECT * FROM agent WHERE id = '$idAgent' AND category = 'Chauffeur'")->fetch();
        if (!$agentCheck) {
            $response["message"] = "L'agent spécifié n'est pas un chauffeur.";
            return $response;
        }

        if ($data->query("UPDATE vehicule SET idAgent='$idAgent', designation='$designation', marque='$marque', numP='$numP', 
                          category='$category', type_carburant='$type_carburant' WHERE id = '$id'")) {
            $response["message"] = "Modification réussie";
            return $response;
        } else {
            $response["message"] = "Échec de modification";
            return $response;
        }
    }

    public static function get_all_Vehicules()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM vehicule ORDER BY id DESC")->fetchAll();
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
        $donnees = $data->query("SELECT * FROM vehicule ORDER BY id DESC LIMIT 1")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }
}
