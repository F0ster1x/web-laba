<?php

namespace App\Controller;

use App\DB\Connector;
use PDO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MainController extends BaseController
{
    public function show(): Response
    {
        $con = new Connector();
        return $this->renderTemplate('Main.php', ['data' => $con->getScreen()]);
    }

    public function infoScreen(array $parameters): Response
    {
        $con = new Connector();
        return $this->renderTemplate('infoScreen.php',
            ['data' => $con->screenshot($parameters['id'])]);
    }

    public function screenshot(): Response
    {
        return $this->renderTemplate('screenshot.php');

    }

    public function addUser(): JsonResponse
    {
        if (!empty($_POST)) {
            $telephone = htmlspecialchars($_POST['userFone']);
            $name = htmlspecialchars($_POST['userName']);
            $email = htmlspecialchars($_POST['userEmail']);
            $password = password_hash($_POST['userPass'], PASSWORD_BCRYPT);
            $registrationDate = date("Y-m-d");

            $query = "INSERT INTO `user` 
    ( `telephone`, `name`, `email`, `data`, `password`) 
     VALUES (:telephone, :name,:email, :data, :password)";
            $params = [
                ':telephone' => $telephone,
                ':name' => $name,
                ':email' => $email,
                ':data' => $registrationDate,
                ':password' => $password,
            ];
            $stmt = Connector::include()->prepare($query);
            $stmt->execute($params);


            return new JsonResponse(["errors" => $stmt->errorInfo()[2] == null ? null : $stmt->errorInfo()[2]]);
        }
        return new JsonResponse(0);
    }

    public function enter(): Response
    {
        $con = new Connector();

        if (!empty($_POST['users_log']) && !empty($_POST['users_pwd'])) {
            $logIN = $_POST['users_log'];
            $Password = $_POST['users_pwd'];
            $data = Connector::include()->prepare("SELECT id_user, password,name FROM `user` WHERE email = ?");

            $data->execute([$logIN,]);

            $users_data = $data->fetch(PDO::FETCH_LAZY);

            if (!empty($users_data)) {
                if (password_verify($Password, $users_data['password'])) {
                    $_SESSION['id_User'] = $users_data['id_user'];
                    $_SESSION['logged'] = 1;
                    $_SESSION['name'] = $users_data['name'];

                } else {
                    echo "<script>alert('Неправильный логин или пароль!')</script>";
                }
            } else {
                echo "<script>alert('Неправильный логин или пароль!')</script>";
            }
        }
        return $this->renderTemplate('Main.php', ['data' => $con->getScreen()]);
    }

    public function exit()
    {
        if (!empty($_POST['but_exit'])) {
            session_unset();
            unset($_SESSION['logged']);
        }
        $con = new Connector();
        return $this->renderTemplate('Main.php', ['data' => $con->getScreen()]);
    }
}