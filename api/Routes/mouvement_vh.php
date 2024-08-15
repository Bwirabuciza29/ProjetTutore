<?php
require("./Controllers/MouvementVh.php");
$data = array();
$url = explode('/', $_SERVER['REQUEST_URI']);
$url_path1 = isset($url[3]) ? $url[3] : null;
$url_path2 = isset($url[4]) ? $url[4] : null;

if ($url_path1 == "mouvementvh") {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if ($url_path2 == "get") {
            $data["response"] = get_all_mouvements();
            echo json_encode($data);
        } elseif ($url_path2 == "getById") {
            $data["response"] = get_mouvement_by_id();
            echo json_encode($data);
        } elseif ($url_path2 == "getLast") {
            $data["response"] = get_last_mouvement();
            echo json_encode($data);
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($url_path2 == "enregistrer") {
            $data["response"] = Enregistrer_Mouvement();
            echo json_encode($data);
        } elseif ($url_path2 == "modifier") {
            $data["response"] = Modifier_Mouvement();
            echo json_encode($data);
        } elseif ($url_path2 == "supprimer") {
            $data["response"] = Supprimer_Mouvement();
            echo json_encode($data);
        }
    }
}
