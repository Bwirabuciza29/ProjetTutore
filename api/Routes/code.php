<?php
//header("Content-Type: application/json"); // "application" doit commencer par une minuscule
require("./Controllers/Code.php");
$data = array();
$url = explode('/', $_SERVER['REQUEST_URI']);
// print_r($url);
$url_path1 = isset($url[3]) ? $url[3] : null;
$url_path2 = isset($url[4]) ? $url[4] : null;
if ($url_path1 == "code") {
    //get all
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($url_path2 == "generate") {
            $data["response"] = generate_and_save_code();
            echo json_encode($data);
        }
    }
}
