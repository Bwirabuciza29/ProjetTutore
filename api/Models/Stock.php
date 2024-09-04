<?php

require_once("./Config.php");

class Stock
{
    public $response = array();

    public static function Enregistrer_Stock($idCat, $designation, $quantite, $dateEntree, $type, $quantiteMouv)
    {
        $data = get_connection();
        $response = array();

        // Enregistrement de la pièce
        if ($data->query("INSERT INTO piece (idCat, designation, quantite, dateEntree) VALUES ('$idCat', '$designation', '$quantite', '$dateEntree')")) {
            $pieceId = $data->lastInsertId();

            // Enregistrement du mouvement
            if ($data->query("INSERT INTO mouvement (quantite, type) VALUES ('$quantiteMouv', '$type')")) {
                $mouvementId = $data->lastInsertId();

                // Calcul des quantités pour le stock
                $qteEntree = 0;
                $qteSortie = 0;

                if ($type == 'Entree') {
                    $qteEntree = $quantite + $quantiteMouv;
                } elseif ($type == 'Sortie') {
                    $qteSortie = $quantiteMouv;
                }

                $total = $qteEntree - $qteSortie;

                // Enregistrement du stock
                if ($data->query("INSERT INTO stock (idPiece, idMouv, QteEntree, QteSortie, total, dateStock) VALUES ('$pieceId', '$mouvementId', '$qteEntree', '$qteSortie', '$total', '$dateEntree')")) {
                    $response["message"] = "Enregistrement réussi";
                    $response["Dernier_Enregistrement"] = self::get_last();
                    return $response;
                } else {
                    $response["message"] = "Échec d'enregistrement du stock";
                    return $response;
                }
            } else {
                $response["message"] = "Échec d'enregistrement du mouvement";
                return $response;
            }
        } else {
            $response["message"] = "Échec d'enregistrement de la pièce";
            return $response;
        }
    }

    public static function Supprimer_Stock($idStock)
    {
        $data = get_connection();
        $response = array();

        // Supprimer le stock
        if ($data->query("DELETE FROM stock WHERE id = '$idStock'")) {
            // Supprimer le mouvement associé
            $data->query("DELETE FROM mouvement WHERE id = (SELECT idMouv FROM stock WHERE id = '$idStock')");
            // Supprimer la pièce associée
            $data->query("DELETE FROM piece WHERE id = (SELECT idPiece FROM stock WHERE id = '$idStock')");

            $response["message"] = "Suppression réussie";
            return $response;
        } else {
            $response["message"] = "Échec de suppression";
            return $response;
        }
    }

    public static function Modifier_Stock($idMouv, $quantite, $type)
    {
        $data = get_connection();
        $response = array();

        // Récupérer les informations actuelles du mouvement et du stock
        $mouvement = $data->query("SELECT * FROM mouvement WHERE id = '$idMouv'")->fetch();
        $stock = $data->query("SELECT * FROM stock WHERE idMouv = '$idMouv'")->fetch();

        if ($mouvement && $stock) {
            $pieceId = $stock['idPiece'];
            $currentQteEntree = $stock['QteEntree'];
            $currentQteSortie = $stock['QteSortie'];
            $total = $stock['total'];

            if ($type == 'Sortie') {
                // Si type est "Sortie", mettre à jour uniquement QteSortie
                $newQteSortie = $currentQteSortie + $quantite;
                $total = $currentQteEntree - $newQteSortie;

                $updateQuery = "UPDATE stock SET QteSortie='$newQteSortie', total='$total' WHERE idMouv = '$idMouv' AND idPiece = '$pieceId'";

                if ($data->query($updateQuery)) {
                    $response["message"] = "Stock mis à jour avec succès";
                } else {
                    $response["message"] = "Échec de la mise à jour du stock";
                }
            } elseif ($type == 'Entree') {
                // Si type est "Entree", mettre à jour uniquement QteEntree
                $newQteEntree = $currentQteEntree + $quantite;
                $total = $newQteEntree - $currentQteSortie;

                $updateQuery = "UPDATE stock SET QteEntree='$newQteEntree', total='$total' WHERE idMouv = '$idMouv' AND idPiece = '$pieceId'";

                if ($data->query($updateQuery)) {
                    $response["message"] = "Stock mis à jour avec succès";
                } else {
                    $response["message"] = "Échec de la mise à jour du stock";
                }
            } else {
                // Si type est autre que "Sortie" ou "Entree", vous pouvez gérer cela comme une erreur ou ne rien faire.
                $response["message"] = "Type de mouvement inconnu. Aucune mise à jour effectuée.";
            }

            // Mise à jour du mouvement
            if ($data->query("UPDATE mouvement SET quantite='$quantite', type='$type' WHERE id = '$idMouv'")) {
                $response["message"] = "Mouvement mis à jour avec succès";
            } else {
                $response["message"] = "Échec de la mise à jour du mouvement";
            }
        } else {
            $response["message"] = "Mouvement ou stock non trouvé";
        }

        return $response;
    }



    public static function get_all_Stock()
    {
        $data = get_connection();
        $query = "SELECT * FROM stockalls";
        $donnees = $data->query($query)->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        } else {
            $response["message"] = "Aucune donnée disponible";
            return $response;
        }
    }

    public static function get_last()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM stock ORDER BY id DESC LIMIT 1")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }
}
