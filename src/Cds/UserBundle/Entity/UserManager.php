<?php
namespace Cds\UserBundle\Entity;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserProviderInterface;
/**
 * Description of UserManager
 *
 * @author clamz
 */
class UserManager{
    protected $em;
    protected $class;
    protected $repository;
    
    /**
     * Constructor
     * 
     * @param EntityManager $em
     * @param string $class 
     */
    public function __construct(EntityManager $em, $class){
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }

    public function findUserBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }
    
    
}

?>
