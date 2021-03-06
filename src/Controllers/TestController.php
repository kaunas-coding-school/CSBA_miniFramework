<?php

namespace CSBA\Controllers;

use CSBA\Libs\JsonResponse;
use CSBA\Libs\Request;
use CSBA\Libs\Response;
use CSBA\Libs\ResponseInterface;
use PDO;

class TestController
{
    public function bandymas(Request $request): ResponseInterface
    {
        $servername = 'db';
        $username = 'devuser';
        $password = 'devpass';
        $dbName = 'csba_db';
        $port = 3306;

        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbName", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// BAD CODE
//        $sqlString = "SELECT * FROM persons WHERE id = '$request->getPayload()['id']'";
//        $stmt = $conn->query($sqlString);

// Good CODE
        $sqlString = "SELECT * FROM persons WHERE id = :id";
        $stmt = $conn->prepare($sqlString);
        $stmt->bindValue(':id', $request->getPayload()['id']);
        $stmt->execute();

        return new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function bandymas2(Request $request): ResponseInterface
    {
        return new JsonResponse($request->toArray());
    }
}
