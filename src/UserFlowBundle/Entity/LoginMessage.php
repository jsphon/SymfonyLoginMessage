<?php

namespace UserFlowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoginMessage
 *
 * @ORM\Table(name="login_message")
 * @ORM\Entity(repositoryClass="UserFlowBundle\Repository\LoginMessageRepository")
 */
class LoginMessage
{
    
    
    public function __construct($user)
    {
        $this->user = $user;
        $this->state = 'none';
    }
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255, unique=true)
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return LoginMessage
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return LoginMessage
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /** @ORM\Column(type="string", nullable=true) */
    private $marking;
    
    public function getMarking()
    {
        return $this->marking;
    }

    public function setMarking($marking)
    {
        $this->marking = $marking;
    }
    
}

