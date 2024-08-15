<?php
require_once("./Models/Reparation.php");

function Enregistrer_Reparation()
{
    $idAgent = isset($_POST["idAgent"]) ? htmlspecialchars(trim($_POST["idAgent"])) : null;
    $idVehicule = isset($_POST["idVehicule"]) ? htmlspecialchars(trim($_POST["idVehicule"])) : null;
    $panne = isset($_POST["panne"]) ? htmlspecialchars(trim($_POST["panne"])) : null;
    $dateRep = isset($_POST["dateRep"]) ? htmlspecialchars(trim($_POST["dateRep"])) : null;
    $duree = isset($_POST["duree"]) ? htmlspecialchars(trim($_POST["duree"])) : null;

    return Reparation::Enregistrer_Reparation($idAgent, $idVehicule, $panne, $dateRep, $duree);
}

function Supprimer_Reparation()
{
    $id = $_POST["id"];
    return Reparation::Supprimer_Reparation($id);
}

function Modifier_Reparation()
{
    $id = $_POST["id"];
    $idAgent = isset($_POST["idAgent"]) ? htmlspecialchars(trim($_POST["idAgent"])) : null;
    $idVehicule = isset($_POST["idVehicule"]) ? htmlspecialchars(trim($_POST["idVehicule"])) : null;
    $panne = isset($_POST["panne"]) ? htmlspecialchars(trim($_POST["panne"])) : null;
    $dateRep = isset($_POST["dateRep"]) ? htmlspecialchars(trim($_POST["dateRep"])) : null;
    $duree = isset($_POST["duree"]) ? htmlspecialchars(trim($_POST["duree"])) : null;

    return Reparation::Modifier_Reparation($id, $idAgent, $idVehicule, $panne, $dateRep, $duree);
}

function get_all_reparations()
{
    return Reparation::get_all_Reparations();
}
