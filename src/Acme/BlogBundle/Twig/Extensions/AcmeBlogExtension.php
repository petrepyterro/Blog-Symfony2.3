<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Acme\BlogBundle\Twig\Extensions;

class AcmeBlogExtension extends \Twig_Extension{
    public function getFilters() {
        return array(
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
        );
    }
    
    public function createdAgo(\DateTime $dateTime) {
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0){
            throw new \InvalidArgumentException("createdAgo is unable to handle dtaes in the future");
        }
        
        $duration = "";
        if ($delta < 60){
            //Seconds
            $time = $delta;
            $duration = $time . " second" . (($time > 1) ? "s" : "") . " ago";
        } elseif ($delta <= 3600) {
            //Mins
            $time = floor($delta / 60);
            $duration = $time . " minute" . (($time > 1) ? "s" : "") . " ago";
        } elseif ($delta <= 86400) {
            //Hours
            $time = floor($delta / 3600);
            $duration = $time . " hour" . (($time > 1) ? "s" : "") . " ago";
        } else {
            //Days
            $time = floor($delta / 86400);
            $duration = $time . " day" . (($time > 1) ? "s" : "") . " ago";
        }
        
        return $duration;
    }
    
    public function getName() {
        return 'acme_blog_extension';
    }
    
}
