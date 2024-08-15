<?php
require_once("./Models/Vehicule.php");

function Enregistrer_Vehicule()
{
    $idAgent = isset($_POST["idAgent"]) ? htmlspecialchars(trim($_POST["idAgent"])) : null;
    $designation = isset($_POST["designation"]) ? htmlspecialchars(trim($_POST["designation"])) : null;
    $marque = isset($_POST["marque"]) ? htmlspecialchars(trim($_POST["marque"])) : null;
    $numP = isset($_POST["numP"]) ? htmlspecialchars(trim($_POST["numP"])) : null;
    $category = isset($_POST["category"]) ? htmlspecialchars(trim($_POST["category"])) : null;
    $type_carburant = isset($_POST["type_carburant"]) ? htmlspecialchars(trim($_POST["type_carburant"])) : null;

    return Vehicule::Enregistrer_Vehicule($idAgent, $designation, $marque, $numP, $category, $type_carburant);
}

function Supprimer_Vehicule()
{
    $id = $_POST["id"];
    return Vehicule::Supprimer_Vehicule($id);
}

function Modifier_Vehicule()
{
    $id = $_POST["id"];
    $idAgent = isset($_POST["idAgent"]) ? htmlspecialchars(trim($_POST["idAgent"])) : null;
    $designation = isset($_POST["designation"]) ? htmlspecialchars(trim($_POST["designation"])) : null;
    $marque = isset($_POST["marque"]) ? htmlspecialchars(trim($_POST["marque"])) : null;
    $numP = isset($_POST["numP"]) ? htmlspecialchars(trim($_POST["numP"])) : null;
    $category = isset($_POST["category"]) ? htmlspecialchars(trim($_POST["category"])) : null;
    $type_carburant = isset($_POST["type_carburant"]) ? htmlspecialchars(trim($_POST["type_carburant"])) : null;

    return Vehicule::Modifier_Vehicule($id, $idAgent, $designation, $marque, $numP, $category, $type_carburant);
}

function get_all_vehicules()
{
    return Vehicule::get_all_Vehicules();
}
