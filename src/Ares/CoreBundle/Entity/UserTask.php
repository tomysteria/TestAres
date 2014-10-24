<?php

namespace Ares\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTask
 *
 * @ORM\Table(name="user_task")
 * @ORM\Entity(repositoryClass="Ares\CoreBundle\Entity\UserTaskRepository")
 */
class UserTask
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\OneToOne(targetEntity="Ares\CoreBundle\Entity\Chrono", cascade={"persist"})
     */  
    private $chrono;

    /**
     * @ORM\ManyToOne(targetEntity="Ares\CoreBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Ares\CoreBundle\Entity\Task")
     * @ORM\JoinColumn(nullable=false)
     */
    private $task;    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set chrono
     *
     * @param \Ares\CoreBundle\Entity\Chrono $chrono
     * @return UserTask
     */
    public function setChrono(\Ares\CoreBundle\Entity\Chrono $chrono = null)
    {
        $this->chrono = $chrono;

        return $this;
    }

    /**
     * Get chrono
     *
     * @return \Ares\CoreBundle\Entity\Chrono 
     */
    public function getChrono()
    {
        return $this->chrono;
    }

    /**
     * Set user
     *
     * @param \Ares\CoreBundle\Entity\User $user
     * @return UserTask
     */
    public function setUser(\Ares\CoreBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ares\CoreBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set task
     *
     * @param \Ares\CoreBundle\Entity\Task $task
     * @return UserTask
     */
    public function setTask(\Ares\CoreBundle\Entity\Task $task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \Ares\CoreBundle\Entity\Task 
     */
    public function getTask()
    {
        return $this->task;
    }
}
