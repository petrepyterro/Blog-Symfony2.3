<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\BlogBundle\Entity\Enquiry;
use Acme\BlogBundle\Form\EnquiryType;

class PageController extends Controller{
    
    public function aboutAction() {
        return $this->render('AcmeBlogBundle:Page:about.html.twig');
    }
    
    public function contactAction() {
        
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);
        
        $request = $this->getRequest();
        
        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            
            if ($form->isValid()){
                $message = \Swift_Message::newInstance()
                        ->setSubject('Contact enquiry from symblog')
                        ->setFrom('enquiries@symblog.co.uk')
                        ->setTo($this->container->getParameter('acme_blog.emails.contact_email'))
                        ->setBody($this->renderView('AcmeBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                $this->get('mailer')->send($message);
                
                $this->get('session')->getFlashBag()->add(
                        'blogger-notice',
                        'Your contact enquiry was successfully sent. Thank you!'
                );
                
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('acme_blog_contact'));
            }
        }
        return $this->render('AcmeBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $blogs = $em->getRepository('AcmeBlogBundle:Blog')->getLatestBlogs();
        
        return $this->render('AcmeBlogBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }
    
    public function sidebarAction() {
        $em = $this->getDoctrine()->getManager();
        
        $tags = $em->getRepository('AcmeBlogBundle:Blog')->getTags();
        
        $tagWeights = $em->getRepository('AcmeBlogBundle:Blog')->getTagWeights($tags);
        
        return $this->render('AcmeBlogBundle:Page:sidebar.html.twig', array(
            'tags' => $tagWeights
        ));
    }
}