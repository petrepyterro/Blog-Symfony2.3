<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller{
    public function indexAction(){
        return $this->render('AcmeBlogBundle:Page:index.html.twig');
    }
    
    public function aboutAction() {
        return $this->render('AcmeBlogBundle:Page:about.html.twig');
    }
    
    public function contactAction() {
        return $this->render('AcmeBlogBundle:Page:contact.html.twig');
    }
}