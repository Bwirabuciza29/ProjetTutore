<?php
require_once("./Models/Stock.php");

function Enregistrer_Stock()
{
    $idCat = isset($_POST["idCat"]) ? htmlspecialchars(trim($_POST["idCat"])) : null;
    $designation = isset($_POST["designation"]) ? htmlspecialchars(trim($_POST["designation"])) : null;
    $quantite = isset($_POST["quantite"]) ? htmlspecialchars(trim($_POST["quantite"])) : null;
    $dateEntree = isset($_POST["dateEntree"]) ? htmlspecialchars(trim($_POST["dateEntree"])) : null;
    $type = isset($_POST["type"]) ? htmlspecialchars(trim($_POST["type"])) : null;
    $quantiteMouv = isset($_POST["quantiteMouv"]) ? htmlspecialchars(trim($_POST["quantiteMouv"])) : null;

    return Stock::Enregistrer_Stock($idCat, $designation, $quantite, $dateEntree, $type, $quantiteMouv);
}

function Supprimer_Stock()
{
    $idStock = $_POST["id"];
    return Stock::Supprimer_Stock($idStock);
}

function Modifier_Stock()
{
    $idMouv = $_POST["idMouv"];
    $quantite = isset($_POST["quantite"]) ? htmlspecialchars(trim($_POST["quantite"])) : null;
    $type = isset($_POST["type"]) ? htmlspecialchars(trim($_POST["type"])) : null;

    return Stock::Modifier_Mouvement($idMouv, $quantite, $type);
}

function get_all_stock()
{
    return Stock::get_all_Stock();
}
