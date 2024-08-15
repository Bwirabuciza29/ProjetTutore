<?php

require_once("./Config.php");

class Admin
{
    public $response = array();

    public static function Enregistrer_Admin($Id_cat, $nom_a, $prenom_a, $email_a, $phone_a, $adresse)
    {
        $data = get_connection();
        $response = array();
        // Générer le matricule
        $matricule = self::generate_matricule($Id_cat);

        // Insérer les données dans la table user_admin
        if ($data->query("INSERT INTO user_admin (Id_cat, nom_a, prenom_a, email_a, phone_a, adresse, matricule) VALUES ('$Id_cat', '$nom_a', '$prenom_a', '$email_a', '$phone_a', '$adresse', '$matricule')")) {
            $response["message"] = "Enregistrement réussi";
            $response["Dernier_Enregistrement"] = self::get_last();
            return $response;
        } else {
            $response["message"] = "Échec d'enregistrement";
            return $response;
        }
    }

    public static function Supprimer_Admin($Id_adm)
    {
        $data = get_connection();
        $response = array();
        if ($data->query("DELETE FROM user_admin WHERE Id_adm = '$Id_adm'")) {
            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de suppression";
            return $response;
        }
    }

    public static function Modifier_Admin($Id_adm, $Id_cat, $nom_a, $prenom_a, $email_a, $phone_a, $adresse)
    {
        $data = get_connection();
        $response = array();
        $matricule = self::generate_matricule($Id_cat);

        if ($data->query("UPDATE user_admin SET Id_cat='$Id_cat', nom_a='$nom_a', prenom_a='$prenom_a', email_a='$email_a', phone_a='$phone_a', adresse='$adresse', matricule='$matricule' WHERE Id_adm = '$Id_adm'")) {
            $response["message"] = "Modification réussie";
            return $response;
        } else {
            $response["message"] = "Échec de modification";
            return $response;
        }
    }

    public static function get_all_Admin()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM user_admin ORDER BY id_adm DESC")->fetchAll();
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
        $donnees = $data->query("SELECT * FROM user_admin ORDER BY id_adm DESC LIMIT 1")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }

    // Fonction pour générer le matricule
    public static function generate_matricule($Id_cat)
    {
        $data = get_connection();

        // Récupérer la désignation de la catégorie d'utilisateur
        $designation = $data->query("SELECT designation FROM cat_user WHERE id_cat = '$Id_cat'")->fetchColumn();
        $prefix = strtoupper(substr($designation, 0, 3));

        // Compter le nombre d'enregistrements existants avec ce préfixe
        $count = $data->query("SELECT COUNT(*) FROM user_admin WHERE matricule LIKE '$prefix%'")->fetchColumn();

        // Générer le matricule avec un nombre incrémental
        $matricule = $prefix . str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        return $matricule;
    }
}
