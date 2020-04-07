<?php

namespace BugApp\Models;

class Bug {
    
    public $id;
    public $title;
    public $description;
    public $createdAt;
    public $closed;
    public $domain;
    public $url;
    public $ip;
    
    function __construct() {
        $this->createdAt = new \DateTime();
        // $this->closed = false;
    }  
   

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt($createdAt)
    {
        if($createdAt == null){

            $date = new \DateTime();

        }else{
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $createdAt);
        }

        $this->closed = $date;

        return $this;
    }

    /**
     * Get the value of closed
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set the value of closed
     *
     * @return  self
     */
    public function setClosed($closed)
    {

        $this->closed = $closed;

        return $this;

    }

    /**
     * Get the value of domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set the value of domain
     *
     * @return  self
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get the value of ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set the value of ip
     *
     * @return  self
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}