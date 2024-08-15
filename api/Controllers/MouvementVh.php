<?php
require_once("./Models/MouvementVh.php");

function Enregistrer_Mouvement()
{
    $idVeh = $_POST["idVeh"];
    $destination = $_POST["destination"];
    $trajet = isset($_POST["trajet"]) ? $_POST["trajet"] : null;
    $consommation = isset($_POST["consommation"]) ? $_POST["consommation"] : null;
    $type_carburant = $_POST["type_carburant"];
    $dateSortie = $_POST["dateSortie"];
    $dateRetour = $_POST["dateRetour"];

    return MouvementVh::Enregistrer_Mouvement($idVeh, $destination, $trajet, $consommation, $type_carburant, $dateSortie, $dateRetour);
}

function Modifier_Mouvement()
{
    $id = $_POST["id"];
    $trajet = isset($_POST["trajet"]) ? $_POST["trajet"] : null;
    $consommation = isset($_POST["consommation"]) ? $_POST["consommation"] : null;

    return MouvementVh::Modifier_Mouvement($id, $trajet, $consommation);
}

function Supprimer_Mouvement()
{
    $id = $_POST["id"];
    return MouvementVh::Supprimer_Mouvement($id);
}

function get_all_mouvements()
{
    return MouvementVh::get_all_Mouvements();
}

function get_mouvement_by_id()
{
    $id = $_GET["id"];
    return MouvementVh::get_Mouvement_By_ID($id);
}

function get_last_mouvement()
{
    return MouvementVh::get_last_Mouvement();
}
