<?php

namespace AppBundle\EventListener;

use Symfony\Component\Security\Http\Event\SwitchUserEvent;
use Twig_Environment as Environment;

class OnSwitchUserSuccessHandler {
    
    private $twig;

    public function __construct( Environment $twig )
    {
        $this->twig    = $twig;
    }

    public function onSwitchUser(SwitchUserEvent $event) 
    {
        print("Hello\n");    
    }
    
}