<?php
namespace App\controllers;

use App\services\Request;

class IndexController
{
    public function index()
    {                               
        $dirTmp = sys_get_temp_dir()."/votantes.json";
        if(file_exists($dirTmp)){
            $response = json_decode(file_get_contents($dirTmp), true);
        }else{
            $url = "https://assembleia.api.pandora.com.br/eventos/7747/votante";
            $req = new Request([
                'Content-Type:application/json',
                'Authorization: Bearer 9dc19260-ff58-4cf2-a5f4-e2f297595fab'
            ]);
            $response = $req->setRequest($url)->getResponse();
            file_put_contents($dirTmp, json_encode($response));
        }
        return $response;
    }
}