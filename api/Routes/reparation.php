<?php
require("./Controllers/Reparation.php");
$data = array();
$url = explode('/', $_SERVER['REQUEST_URI']);

$url_path1 = isset($url[3]) ? $url[3] : null;
$url_path2 = isset($url[4]) ? $url[4] : null;

if ($url_path1 == "reparation") {
    // GET all reparations
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if ($url_path2 == "get") {
            $data["response"] = get_all_reparations();
            echo json_encode($data);
        }
    }
    // POST actions
    elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($url_path2 == "enregistrer") {
            $data["response"] = Enregistrer_Reparation();
            echo json_encode($data);
        } elseif ($url_path2 == "modifier") {
            $data["response"] = Modifier_Reparation();
            echo json_encode($data);
        } elseif ($url_path2 == "supprimer") {
            $data["response"] = Supprimer_Reparation();
            echo json_encode($data);
        }
    }
}
