<?php
require_once("./Models/AllLog.php");

function Enregistrer_Log()
{
    $Id_adm = isset($_POST["Id_adm"]) ? htmlspecialchars(trim($_POST["Id_adm"])) : null;
    $psw = isset($_POST["psw"]) ? htmlspecialchars(trim($_POST["psw"])) : null;

    return Log::Enregistrer_Log($Id_adm, $psw);
}

function Supprimer_Log()
{
    $id_psw = $_POST["id_psw"];
    return Log::Supprimer_Log($id_psw);
}

function Modifier_Log()
{
    $id_psw = $_POST["id_psw"];
    $Id_adm = isset($_POST["Id_adm"]) ? htmlspecialchars(trim($_POST["Id_adm"])) : null;
    $psw = isset($_POST["psw"]) ? htmlspecialchars(trim($_POST["psw"])) : null;

    return Log::Modifier_Log($id_psw, $Id_adm, $psw);
}

function get_all_log()
{
    return Log::get_all_Log();
}
