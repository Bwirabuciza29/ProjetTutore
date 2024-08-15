<?php
require_once("./Models/Category.php");

function Enregistrer_Category()
{
    $designation = isset($_POST["designation"]) ? htmlspecialchars(trim($_POST["designation"])) : null;
    return Category::Enregistrer_Category($designation);
}

function Supprimer_Category()
{
    $id = $_POST["id"];
    return Category::Supprimer_Category($id);
}

function Modifier_Category()
{
    $id = $_POST["id"];
    $designation = isset($_POST["designation"]) ? htmlspecialchars(trim($_POST["designation"])) : null;
    return Category::Modifier_Category($id, $designation);
}

function get_all_categories()
{
    return Category::get_all_Category();
}
