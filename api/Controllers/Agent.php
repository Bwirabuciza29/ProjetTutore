<?php
require_once("./Models/Agent.php");

function Enregistrer_Agent()
{
    $noms = isset($_POST["noms"]) ? htmlspecialchars(trim($_POST["noms"])) : null;
    $category = isset($_POST["category"]) ? htmlspecialchars(trim($_POST["category"])) : null;
    $dateNaissance = isset($_POST["dateNaissance"]) ? htmlspecialchars(trim($_POST["dateNaissance"])) : null;
    $lieuNaissance = isset($_POST["lieuNaissance"]) ? htmlspecialchars(trim($_POST["lieuNaissance"])) : null;
    $email = isset($_POST["email"]) ? htmlspecialchars(trim($_POST["email"])) : null;
    $tel = isset($_POST["tel"]) ? htmlspecialchars(trim($_POST["tel"])) : null;

    // Gestion de l'upload de la photo
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $photo = basename($_FILES["photo"]["name"]);
        $target_dir = "../images/";
        $target_file = $target_dir . $photo;

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = $target_file;
        } else {
            $photo = null;
        }
    } else {
        $photo = null;
    }

    return Agent::Enregistrer_Agent($noms, $category, $dateNaissance, $lieuNaissance, $email, $tel, $photo);
}

function Supprimer_Agent()
{
    $id = $_POST["id"];
    return Agent::Supprimer_Agent($id);
}

function Modifier_Agent()
{
    $id = $_POST["id"];
    $noms = isset($_POST["noms"]) ? htmlspecialchars(trim($_POST["noms"])) : null;
    $category = isset($_POST["category"]) ? htmlspecialchars(trim($_POST["category"])) : null;
    $dateNaissance = isset($_POST["dateNaissance"]) ? htmlspecialchars(trim($_POST["dateNaissance"])) : null;
    $lieuNaissance = isset($_POST["lieuNaissance"]) ? htmlspecialchars(trim($_POST["lieuNaissance"])) : null;
    $email = isset($_POST["email"]) ? htmlspecialchars(trim($_POST["email"])) : null;
    $tel = isset($_POST["tel"]) ? htmlspecialchars(trim($_POST["tel"])) : null;

    // Gestion de l'upload de la nouvelle photo si nécessaire
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $photo = basename($_FILES["photo"]["name"]);
        $target_dir = "../images/";
        $target_file = $target_dir . $photo;

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = $target_file;
        } else {
            $photo = null;
        }
    } else {
        $photo = null;
    }

    return Agent::Modifier_Agent($id, $noms, $category, $dateNaissance, $lieuNaissance, $email, $tel, $photo);
}

function get_all_agents()
{
    return Agent::get_all_Agents();
}
function get_all_mecaniciens()
{
    return Agent::get_all_Mecaniciens();
}

function get_all_chauffeurs()
{
    return Agent::get_all_Chauffeurs();
}
