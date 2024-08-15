<?php
header('Content-Type: Application/json;charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: *');
header('Access-Control-Allow-Headers: *');
$user = 'emmanuel';
$mdp = 'mdp';
if ((isset($_GET['user']) && $_GET['user'] == 'emmanuel' || isset($_GET['user']) && $_GET['user'] == $user)
    && (isset($_GET['mdp']) && $_GET['mdp'] == 'isc' || isset($_GET['mdp']) && $_GET['mdp'] == $mdp)
) {

    require "./Routes/user_route.php";
    require "./Routes/useradmin.php";
    require "./Routes/catuser.php";
    require "./Routes/alllog.php";
    // GESTION CHAROI
    require "./Routes/agent.php";
    require "./Routes/vehicule.php";
    require "./Routes/reparation.php";
    // GESTION STOCK
    require "./Routes/category.php";
    require "./Routes/stock.php";
} else {

    $retour["message"] = "accès réfusé";
    echo json_encode($retour);
    exit;
}
