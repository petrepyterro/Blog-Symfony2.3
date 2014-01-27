<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Acme\BlogBundle\Entity;

class Enquiry{
    protected $name;
    
    protected $email;
    
    protected $subject;
    
    protected $body;
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    
    public function getSubject(){
        return $this->subject;
    }
    
    public function setSubject($subject){
        $this->subject = $subject;
    }
    
    public function getBody(){
        return $this->body;
    }
    
    public function setBody($body){
        $this->body = $body;
    }

}