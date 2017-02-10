<?php

namespace UserFlowBundle\EventListener;

use Symfony\Component\Security\Http\Event\SwitchUserEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Workflow\Registry;


use Monolog\Logger;

class OnSwitchUserSuccessHandler {

    private $logger;
    private $em;
    private $workflowRegistry;
    private $user;
    
    public function __construct(EntityManager $entityManager, Registry $workflowRegistry, Logger $logger, $user)
    {
        $this->logger = $logger;
        $this->em = $entityManager;
        $this->workflowRegstry = $workflowRegistry;
        $this->user=$user;
    }
    
    public function onSwitchUser(SwitchUserEvent $event) 
    {
        $user = $event->getTargetUser();
        $repository = $this->em->getRepository('UserFlowBundle:LoginMessage');
        $repository->setUserState($user, 'show');
        #$loginMessage = $repository->findOneOrCreateByUser($user);
        #$this->logger->info('hello world ' . $event->getTargetUser());
        
    }
    
}