<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */

    protected  $firstName;



    /**
     * @ORM\Column(type="string")
     */

    protected  $website;

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website): void
    {
        $this->website = $website;
    }


    /**
     * @ORM\Column(type="string")
     */

    protected  $linkedit;

    /**
     * @return mixed
     */
    public function getLinkedit()
    {
        return $this->linkedit;
    }

    /**
     * @param mixed $linkedit
     */
    public function setLinkedit($linkedit): void
    {
        $this->linkedit = $linkedit;
    }







    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getId()
    {
        return $this->id;
    }
}
