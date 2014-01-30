<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Blog controller
 */

class BlogController extends Controller{
    /**
     * Show a blog entry
     */
    public function showAction($id){
        $em = $this->getDoctrine()->getManager();
        
        $blog = $em->getRepository('AcmeBlogBundle:Blog')->find($id);
        
        if (!$blog){
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        
        $comments = $em->getRepository('AcmeBlogBundle:Comment')->getCommentsForBlog($blog->getId());
                
        return $this->render('AcmeBlogBundle:Blog:show.html.twig', array(
            'blog' => $blog,
            'comments' => $comments
        ));
    }
}

