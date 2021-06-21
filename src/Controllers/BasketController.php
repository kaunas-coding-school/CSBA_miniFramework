<?php

namespace CSBA\Controllers;

use CSBA\Libs\Request;
use CSBA\Libs\ResponseInterface;
use CSBA\Libs\SuccessJsonResponse;

class BasketController
{
    public function detiIKrepseli(Request $request): ResponseInterface
    {
        $preke = $request->toArray();
        // jungiamers i db
        // $dbConn = new DBCoonect();

        // saugom $preke gaudami vartotojo ID ir jo krepseli
        // $rez = $dbConnect->insert('INSERT....', $preke);

        // if $rez !== true .. throw new Exception('Oi kilo klaida');
        // gauname sekmes atsakyma

        return new SuccessJsonResponse($preke);
    }
}
