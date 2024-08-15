<?php
require_once("./Controllers/User_ctrol.php");
$data = array();
$url = explode('/', $_SERVER['REQUEST_URI']);
// print_r($url);
$url_path1 = isset($url[3]) ? $url[3] : null; // Vérifie si $url[4] existe pour éviter une notice undefined index
$url_path2 = isset($url[4]) ? $url[4] : null;
//get all
if ($url_path1 == "authen") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // if ($url_path2 == "u_auth"){
        echo authen_admin();
        // }
    }
}
