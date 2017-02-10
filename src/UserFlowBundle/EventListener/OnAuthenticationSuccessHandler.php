<?php

namespace AppBundle\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManager;

class OnAuthenticationSuccessHandler {

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) 
    {
        print 'hello';
    }
    
}