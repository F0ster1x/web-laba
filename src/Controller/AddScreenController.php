<?php

namespace App\Controller;

use App\DB\Connector;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

session_start();

class AddScreenController extends BaseController
{
    public function addScreenshot(): Response
    {
        $con = new Connector();
        $id_User = $_SESSION['id_User'];
        $photo = "img/" . basename($_FILES['file']['name']);
        $uploadfile = "img/" . basename($_FILES['file']['name']);

        $dataScreen = date("Y-m-d");
        if (empty($_POST['check'])) {
            $access = 0;
        } else {
            $access = $_POST['check'];
        }
        $types = array('image/png', 'image/jpeg', 'image/jpg');


        if (!in_array($_FILES['file']['type'], $types)) {
            echo "<script> alert('Запрещенный тип файла! Формат должен быть jpeg, png или jpg!')</script>";
            return $this->renderTemplate('index.php', ['data' => $con->getScreen()]);
            die();
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            $query = "INSERT INTO `screen` (`dataScreen`, `id_user`, `privately`,`link`)
    VALUES (:dataScreen,:id_user,:privately,:link)";
            $params = [
                ':dataScreen' => $dataScreen,
                ':id_user' => $id_User,
                ':privately' => $access,
                ':link' => $uploadfile
            ];
            $stmt = Connector::include()->prepare($query);
            $stmt->execute($params);


            return $this->renderTemplate('index.php', ['data' => $con->getScreen()]);

        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
            return $this->renderTemplate('index.php', ['data' => $con->getScreen()]);
        }
        return $this->renderTemplate('index.php', ['data' => $con->getScreen()]);
    }

}