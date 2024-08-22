<?php

require_once("./Config.php");

class Agent
{
    public $response = array();

    // Fonction pour générer automatiquement le matricule
    private static function generateMatricule($category)
    {
        $prefix = strtoupper(substr($category, 0, 3)); // Prend les 3 premières lettres de la catégorie
        $data = get_connection();

        // Compte les agents existants dans la même catégorie pour incrémenter le numéro
        $count = $data->query("SELECT COUNT(*) as total FROM agent WHERE category = '$category'")->fetch()['total'];
        $increment = str_pad($count + 1, 4, '0', STR_PAD_LEFT); // Ajoute des zéros pour avoir 4 chiffres

        return $prefix . $increment;
    }

    public static function Enregistrer_Agent($noms, $category, $dateNaissance, $lieuNaissance, $email, $tel, $photo)
    {
        $data = get_connection();
        $response = array();

        // Générer le matricule
        $matricule = self::generateMatricule($category);

        // Insérer les données dans la table agent
        if ($data->query("INSERT INTO agent (matricule, noms, category, dateNaissance, lieuNaissance, email, tel, photo) 
                          VALUES ('$matricule', '$noms', '$category', '$dateNaissance', '$lieuNaissance', '$email', '$tel', '$photo')")) {
            $response["message"] = "Enregistrement réussi";
            $response["Dernier_Enregistrement"] = self::get_last();
            return $response;
        } else {
            $response["message"] = "Échec d'enregistrement";
            return $response;
        }
    }

    public static function Supprimer_Agent($id)
    {
        $data = get_connection();
        $response = array();
        if ($data->query("DELETE FROM agent WHERE id = '$id'")) {
            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de suppression";
            return $response;
        }
    }

    public static function Modifier_Agent($id, $noms, $category, $dateNaissance, $lieuNaissance, $email, $tel, $photo = null)
    {
        $data = get_connection();
        $response = array();

        // Si la catégorie a changé, on doit mettre à jour le matricule
        $matricule = self::generateMatricule($category);

        $query = "UPDATE agent SET matricule='$matricule', noms='$noms', category='$category', dateNaissance='$dateNaissance', 
                  lieuNaissance='$lieuNaissance', email='$email', tel='$tel'";

        if ($photo) {
            $query .= ", photo='$photo'";
        }

        $query .= " WHERE id = '$id'";

        if ($data->query($query)) {
            $response["message"] = "Modification réussie";
            return $response;
        } else {
            $response["message"] = "Échec de modification";
            return $response;
        }
    }

    public static function get_all_Agents()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM agent ORDER BY id DESC")->fetchAll();
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
        $donnees = $data->query("SELECT * FROM agent ORDER BY id DESC LIMIT 1")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }
    public static function get_all_Mecaniciens()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM agent WHERE category = 'Mecanicien' ORDER BY id DESC")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        } else {
            $response["message"] = "Aucun mécanicien trouvé";
            return $response;
        }
    }

    public static function get_all_Chauffeurs()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM agent WHERE category = 'Chauffeur' ORDER BY id DESC")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        } else {
            $response["message"] = "Aucun chauffeur trouvé";
            return $response;
        }
    }
}
