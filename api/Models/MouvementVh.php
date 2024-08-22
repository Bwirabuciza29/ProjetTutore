<?php

require_once("./Config.php");

class MouvementVh
{
    public $response = array();

    public static function Enregistrer_Mouvement($idVeh, $destination, $trajet, $consommation, $type_carburant, $dateSortie, $dateRetour)
    {
        $data = get_connection();
        $response = array();

        $query = "INSERT INTO mouvement_vh (idVeh, destination, trajet, consommation, type_carburant, dateSortie, dateRetour) 
                  VALUES ('$idVeh', '$destination', '$trajet', '$consommation', '$type_carburant', '$dateSortie', '$dateRetour')";

        if ($data->query($query)) {
            $response["message"] = "Enregistrement réussi";
            return $response;
        } else {
            $response["message"] = "Échec d'enregistrement";
            return $response;
        }
    }

    public static function Modifier_Mouvement($id, $trajet, $consommation)
    {
        $data = get_connection();
        $response = array();

        $query = "UPDATE mouvement_vh SET trajet = '$trajet', consommation = '$consommation' WHERE id = '$id'";

        if ($data->query($query)) {
            $response["message"] = "Mouvement mis à jour avec succès";
            return $response;
        } else {
            $response["message"] = "Échec de la mise à jour du mouvement";
            return $response;
        }
    }

    public static function Supprimer_Mouvement($id)
    {
        $data = get_connection();
        $response = array();

        $query = "DELETE FROM mouvement_vh WHERE id = '$id'";

        if ($data->query($query)) {
            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de la suppression";
            return $response;
        }
    }

    public static function get_all_Mouvements()
    {
        $data = get_connection();
        $query = "SELECT * FROM mouveall";
        $donnees = $data->query($query)->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        } else {
            $response["message"] = "Aucune donnée disponible";
            return $response;
        }
    }

    public static function get_Mouvement_By_ID($id)
    {
        $data = get_connection();
        $query = "SELECT mv.id, v.designation AS vehicule, mv.destination, mv.trajet, mv.consommation, mv.type_carburant, mv.dateSortie, mv.dateRetour, a.noms AS chauffeur
                  FROM mouvement_vh mv
                  JOIN vehicule v ON mv.idVeh = v.id
                  JOIN agent a ON v.idAgent = a.id
                  WHERE a.category = 'Chauffeur' AND mv.id = '$id'";
        $donnees = $data->query($query)->fetch();
        if ($donnees) {
            return $donnees;
        } else {
            $response["message"] = "Aucune donnée trouvée";
            return $response;
        }
    }

    public static function get_last_Mouvement()
    {
        $data = get_connection();
        $query = "SELECT mv.id, v.designation AS vehicule, mv.destination, mv.trajet, mv.consommation, mv.type_carburant, mv.dateSortie, mv.dateRetour, a.noms AS chauffeur
                  FROM mouvement_vh mv
                  JOIN vehicule v ON mv.idVeh = v.id
                  JOIN agent a ON v.idAgent = a.id
                  WHERE a.category = 'Chauffeur'
                  ORDER BY mv.id DESC
                  LIMIT 1";
        $donnees = $data->query($query)->fetch();
        if ($donnees) {
            return $donnees;
        } else {
            $response["message"] = "Aucun mouvement trouvé";
            return $response;
        }
    }
}
