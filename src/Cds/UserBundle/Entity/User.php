<?php
namespace Cds\UserBundle\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of User
 *
 * @author clamz
 */

/**
 * @orm:Entity
 */
class User{
    
    
    public function __construct()
    {
        
        $this->createdAt = new \DateTime('NOW');
        $this->updatedAt = new \DateTime('NOW');
    }
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @orm:Column(type="string", length="60")
     */
    protected $username;
    
    /**
    * User creation date (on this website)
    *
    * @orm:Column(type="datetime")
    */
    protected $createdAt = null;

    /**
    * User update date (on this website)
    *
    * @orm:Column(type="datetime")
    */
    protected $updateAt = null;


    

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateAt
     *
     * @param datetime $updateAt
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;
    }

    /**
     * Get updateAt
     *
     * @return datetime $updateAt
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

      
   
}