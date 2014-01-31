<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BlogBundle\Entity\Comment;
use Acme\BlogBundle\Form\CommentType;

/**
 * Comment controller
 */

class CommentController extends Controller{
    public function newAction($blog_id) {
        $blog = $this->getBlog($blog_id);
        
        $comment = new Comment();
        $comment->setBlog($blog);
        $form = $this->createForm(new CommentType(), $comment);
        
        return $this->render('AcmeBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }
    
    public function createAction($blog_id) {
        $blog = $this->getBlog($blog_id);
        
        $comment = new Comment();
        $comment->setBlog($blog);
        $request = $this->getRequest();
        $form = $this->createForm(new CommentType(), $comment);
        
        $form->handleRequest($request);
        
        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            
            
            return $this->redirect($this->generateUrl('acme_blog_blog_show', array(
                'id' => $comment->getBlog()->getId())).
                '#comment-' . $comment->getId()   
            );
        }
        
        return $this->render('AcmeBlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }
    
    protected function getBlog($blog_id) {
        $em = $this->getDoctrine()->getManager();
        
        $blog = $em->getRepository('AcmeBlogBundle:Blog')->find($blog_id);
        
        if (!$blog){
            throw new $this->createNotFoundException('Unable to find Blog post.');
        }
        
        return $blog;
    }
}

