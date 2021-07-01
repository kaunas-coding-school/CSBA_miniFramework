<?php

namespace CSBA\Controllers;

use CSBA\Libs\JsonResponse;
use CSBA\Libs\Request;
use CSBA\Libs\Response;
use CSBA\Libs\ResponseInterface;
use PDO;

class GroupController
{
    public function list(): ResponseInterface
    {
        $servername = 'db';
        $username = 'devuser';
        $password = 'devpass';
        $dbName = 'csba_db';
        $port = 3306;

        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbName", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlString = "SELECT * FROM gruops";
        $stmt = $conn->query($sqlString);

        return new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function show(Request $request): ResponseInterface
    {

        // ...

        $group = "????";

        return  new Response($group);
    }

    public function create()
    {
        // ....
    }

    public function delete()
    {
        // ....
    }
}
