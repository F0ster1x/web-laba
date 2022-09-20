<?php

namespace App\DB;

use PDO;

class Connector
{
    public static function include()
    {
        $ini_array = parse_ini_file(__DIR__ . "/../../config/php.ini");

        $str = 'mysql:host=' . $ini_array['host'] . ';dbname=' . $ini_array['dbname'];
        $str1 = $ini_array['login'];
        $str2 = $ini_array['password'];

        try {
            return $dbh = new PDO($str, $str1, $str2);
        } catch
        (\Exception $exception) {
            echo "Ошибка при подключении к БД<br>";
            echo $exception->getMessage();
            die();
        }
    }

    public function getScreen()
    {
        return Connector::include()->query("SELECT * FROM screen")
            ->fetchAll(PDO::FETCH_ASSOC);

    }

    public function screenshot(int $id)
    {
        $about_user = Connector::include()
            ->prepare("SELECT * FROM screen WHERE id_screen = ?");
        $about_user->execute([$id]);
        return $about_user->fetch(PDO::FETCH_LAZY);
    }

}