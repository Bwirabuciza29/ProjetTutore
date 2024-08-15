<?php

require_once("./Config.php");

class User_modl
{
  public $response = array();
  private $res;
  // AUTHENTIFICATION
  public static function authen($login, $psw)
  {
    $data = get_connection();
    // Utilisation des attributs dans lesquels sont stokés les valeurs des paramètres
    if (!empty($login) and !empty($psw)) {
      // controle de securite
      $login = isset($login) ? $login = htmlspecialchars($login) : $login = trim($login);
      $passw = isset($psw) ? $passw = htmlspecialchars($psw) : $passw = trim($psw);
      // hashage du mot de passe entree
      $passw = sha1($passw);
      // recherche clé administrateur
      $sql = $data->prepare("SELECT * FROM all_log a INNER JOIN user_admin ad ON ad.Id_adm = a.Id_adm INNER JOIN cat_user c 
        ON c.id_cat = ad.id_cat WHERE ad.email_a = ? AND a.psw = ?");
      $sql->execute(array($login, $passw));
      $exist = $sql->rowCount();
      if ($exist == 1) {
        $datas = $sql->fetch();
        // renvoie de quelques elements
        echo json_encode([
          'msg' => 'Utilisateur connecté...',
          'n_user' => $datas['email_a'],
          'u_role' => $datas['designation'],
          'nom' => $datas['nom_a'],
          'phone' => $datas['phone_a'],
          'token' => sha1($datas['email_a'])
        ]);
        // sauvegarde de la connexion
        $req = $data->prepare('INSERT INTO authentification_u(id_adm) VALUES (?)');
        $req->execute(array($datas['Id_adm']));
      } else {
        // renvoie de quelques elements
        echo json_encode([
          'msg' => "L'utilisateur n'existe pas. Veuillez entrer les bonnes informations svp !"
        ]);
      }
    } else {
      // renvoie de quelques elements
      echo json_encode([
        'msg' => "Aucune information ne doit être manquante svp !"
      ]);
    }
  }
}
