<?php

namespace BugApp\Controllers;

use BugApp\Models\BugManager;
use BugApp\Models\Bug;
use GuzzleHttp\Client;

class bugController
{

    public function list()
    {

        $bugManager = new BugManager();

        $bugs = $bugManager->findAll();

        $json = json_encode($bugs);

        return $this->sendHttpResponse($json, 200);
    }

    public function show($id)
    {
        $bugManager = new BugManager();
        $bug = $bugManager->find($id);
        $json = json_encode($bug);
        return $this->sendHttpResponse($json, 200);

        // TODO: Récupérer le Bug

        // TODO: Encoder le Bug

        // TODO: Retourner la réponse Json

    }

    public function update($id)
    {

        $bugManager = new BugManager();

        $bug = $bugManager->find($id);

        // TODO: Récupérer les données en PATCH

        // TODO: Set Title

        // TODO: Set Description

        // TODO: Set Url

        // TODO: (optionnal) Set Domain + set Ip

        // TODO: Set Closed

        // TODO: persister les données

        // TODO: Encoder le Bug

        // TODO: Retourner la réponse Json

    }



    public function add()
    {
        
        $bugManager = new BugManager();

        $bug = new Bug();

        // TODO: Set Title

        // TODO: Set Description

        // TODO: Set Url

        // TODO: (optionnal) Set Domain + set Ip

        // TODO: Persister le Bug en BDD et récupérer l'id

        // Set Bug Id

        // TODO: Encoder le Bug

        // TODO: Retourner la réponse Json
    }


    public static function sendHttpResponse($content, $code = 200)
    {
        http_response_code($code);

        header('Content-Type: application/json');

        echo $content;
    }
}
