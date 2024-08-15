<?php
require("./Models/User_modl.php");
//enregistrement
$retour =array();
function authen_admin()
{
    $login = $_POST["login"];
    $psw = $_POST["psw"];
    //appel model nregistrement personne
    return User_modl::authen($login, $psw);
}