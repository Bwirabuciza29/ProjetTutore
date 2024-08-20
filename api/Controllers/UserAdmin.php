<?php
require_once("./Models/UserAdmin.php");

function Enregistrer_Admin()
{
    $Id_cat = isset($_POST["Id_cat"]) ? htmlspecialchars(trim($_POST["Id_cat"])) : null;
    $nom_a = isset($_POST["nom_a"]) ? htmlspecialchars(trim($_POST["nom_a"])) : null;
    $prenom_a = isset($_POST["prenom_a"]) ? htmlspecialchars(trim($_POST["prenom_a"])) : null;
    $email_a = isset($_POST["email_a"]) ? htmlspecialchars(trim($_POST["email_a"])) : null;
    $phone_a = isset($_POST["phone_a"]) ? htmlspecialchars(trim($_POST["phone_a"])) : null;
    $adresse = isset($_POST["adresse"]) ? htmlspecialchars(trim($_POST["adresse"])) : null;

    return Admin::Enregistrer_Admin($Id_cat, $nom_a, $prenom_a, $email_a, $phone_a, $adresse);
}

function Supprimer_Admin()
{
    $id_adm = $_POST["id_adm"];
    return Admin::Supprimer_Admin($id_adm);
}

function Modifier_Admin()
{
    $id_adm = $_POST["id_adm"];
    $Id_cat = isset($_POST["Id_cat"]) ? htmlspecialchars(trim($_POST["Id_cat"])) : null;
    $nom_a = isset($_POST["nom_a"]) ? htmlspecialchars(trim($_POST["nom_a"])) : null;
    $prenom_a = isset($_POST["prenom_a"]) ? htmlspecialchars(trim($_POST["prenom_a"])) : null;
    $email_a = isset($_POST["email_a"]) ? htmlspecialchars(trim($_POST["email_a"])) : null;
    $phone_a = isset($_POST["phone_a"]) ? htmlspecialchars(trim($_POST["phone_a"])) : null;
    $adresse = isset($_POST["adresse"]) ? htmlspecialchars(trim($_POST["adresse"])) : null;

    return Admin::Modifier_Admin($id_adm, $Id_cat, $nom_a, $prenom_a, $email_a, $phone_a, $adresse);
}

function get_all_admin()
{
    return Admin::get_all_Admin();
}
