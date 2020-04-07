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

        if (isset($_GET['isClosed'])) {
            $bugs = $bugManager->findByClosed($_GET['isClosed']);
        } else {
            $bugs = $bugManager->findAll();
        }

        $json = json_encode($bugs);
        $this->sendHttpResponse($json, 200);
    }


    public function show($id)
    {
        $bugManager = new BugManager();
        $bug = $bugManager->find($id);
        $json = json_encode($bug);
        return $this->sendHttpResponse($json, 200);
    }


    public function update($id)
    {
        parse_str(file_get_contents('php://input'), $_PATCH);

        $bugManager = new BugManager();
        $bug = new Bug();

        $bug->setId($id);

        if (isset($_PATCH['title'])) {
            $bug->setTitle($_PATCH['title']);
        }

        if (isset($_PATCH['description'])) {
            $bug->setDescription($_PATCH['description']);
        }

        if (isset($_PATCH['url'])) {
            $bug->setUrl($_PATCH['url']);
        }

        if (isset($_PATCH['closed'])) {
            $bug->setClosed($_PATCH['closed']);
        }

        $bugManager->update($bug);

        $json = json_encode($bug);
        return $this->sendHttpResponse($json, 200);
    }


    public function add()
    {
        $bugManager = new BugManager();

        $bug = new Bug();

        if (isset($_POST['title'])) {
            $bug->setTitle($_POST['title']);
        }

        if (isset($_POST['description'])) {
            $bug->setDescription($_POST['description']);
        }

        if (isset($_POST['url'])) {
            $bug->setUrl($_POST['url']);
        }

        $newBugId = $bugManager->add($bug);
        $bug->setId($newBugId);

        $json = json_encode($bug);
        return $this->sendHttpResponse($json, 200);
    }


    public function pageNotFound() {
        return $this->sendHttpResponse("Page not found", 404);
    }


    public static function sendHttpResponse($content, $code = 200)
    {
        http_response_code($code);

        header('Content-Type: application/json');

        echo $content;
    }
}
