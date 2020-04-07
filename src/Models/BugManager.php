<?php

namespace BugApp\Models;

use BugApp\Models\Bug;
use BugApp\Manager;

class BugManager extends Manager
{

    public function add(Bug $bug){

        $dbh = $this->connectDb();  

            $sql = "INSERT INTO bugs (title, description, closed, domain, ip, url, createdAt) VALUES (:title, :description, :closed, :domain, :ip, :url, :createdAt)";
            $sth = $dbh->prepare($sql);
            $sth->execute([
                "title" => $bug->getTitle(),
                "description" => $bug->getDescription(),
                "closed" => 0,
                "domain" => $bug->getDomain(),
                "url" => $bug->getUrl(),
                "ip" => $bug->getIp(),
                "createdAt" => $bug->getCreatedAt()->format("Y-m-d H:i:s")
            ]); 

            $id = $dbh->lastInsertId();

            return $id;

    }

    public function update(Bug $bug)
    {
        $dbh = $this->connectDb();  

            if($bug->getClosed() != null){
                $bugGetClosed = $bug->getClosed()->format("Y-m-d H:i:s");
            } else{
                $bugGetClosed = null;
            }

            $sql = "UPDATE bugs SET title = :title, description = :description, closed = :closed, domain = :domain, ip = :ip, url = :url WHERE id =:id";
            $sth = $dbh->prepare($sql);
            $sth->execute([
                "id" => $bug->getId(),
                "title" => $bug->getTitle(),
                "description" => $bug->getDescription(),
                "closed" => $bugGetClosed,
                "domain" => $bug->getDomain(),
                "ip" => $bug->getIp(),
                "url" => $bug->getUrl(),
            ]);
    }

    public function find($id)
    {
        $dbh = $this->connectDb();

        $sth = $dbh->prepare('SELECT * FROM bugs WHERE id = :id');
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);

        $bug = new Bug();
        $bug->setId($result["id"]);
        $bug->setTitle($result["title"]);
        $bug->setDescription($result["description"]);
        $bug->setCreatedAt($result["createdAt"]);
        $bug->setClosed($result["closed"]);
        $bug->setDomain($result["domain"]);
        $bug->setUrl($result["url"]);
        $bug->setIp($result["ip"]);      

        return $bug;
    }


    public function findAll()
    {
        $dbh = $this->connectDb();

        $results = $dbh->query('SELECT * FROM `bugs` ORDER BY `id`', \PDO::FETCH_ASSOC);

        $bugs = [];

        // Parcours des résultats
        foreach ($results as $result) {
            $bug = new Bug();
            $bug->setId($result["id"]);
            $bug->setTitle($result["title"]);
            $bug->setDescription($result["description"]);
            $bug->setCreatedAt($result["createdAt"]);
            $bug->setClosed($result["closed"]);
            $bug->setDomain($result["domain"]);
            $bug->setUrl($result["url"]);
            $bug->setIp($result["ip"]);
            
            $bugs[] = $bug;
        }

        return $bugs;
    }

    public function findByClosed($bool){

        $dbh = $this->connectDb();

        if($bool === "false"){
            $results = $dbh->query('SELECT * FROM `bugs` WHERE closed="0" ORDER BY `id`', \PDO::FETCH_ASSOC);
        }else{
            $results = $dbh->query('SELECT * FROM `bugs` WHERE closed="1" ORDER BY `id`', \PDO::FETCH_ASSOC);
        }

        $bugs = [];

        // Parcours des résultats
        foreach ($results as $result) {
            $bug = new Bug();
            $bug->setId($result["id"]);
            $bug->setTitle($result["title"]);
            $bug->setDescription($result["description"]);
            $bug->setCreatedAt($result["createdAt"]);
            $bug->setClosed($result["closed"]);
            $bug->setDomain($result["domain"]);
            $bug->setUrl($result["url"]);
            $bug->setIp($result["ip"]);
            
            $bugs[] = $bug;
        }

        return $bugs;

    }

}
