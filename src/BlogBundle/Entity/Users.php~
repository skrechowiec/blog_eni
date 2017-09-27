<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\UsersRepository")
 * @UniqueEntity("email", message="L'email est déja enregistré")
 * @UniqueEntity("username", message="Le pseudo est déjà utilisé")
 *
 */
class Users implements UserInterface
{
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateregistration", type="datetime")
     */
    private $dateregistration;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=25)
     */
    private $roles;


    /**
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Article", mappedBy="auteur" , cascade={"remove"})
     */
    private $listeArticlesCrees;

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
     * Set username
     *
     * @param string $username
     *
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set dateregistration
     *
     * @param \DateTime $dateregistration
     *
     * @return Users
     */
    public function setDateregistration($dateregistration)
    {
        $this->dateregistration = $dateregistration;

        return $this;
    }

    /**
     * Get dateregistration
     *
     * @return \DateTime
     */
    public function getDateregistration()
    {
        return $this->dateregistration;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return Users
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return [$this->roles];
    }

        public function getSalt(){}

    public function eraseCredentials(){}

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listeArticlesCrees = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listeArticlesCree
     *
     * @param \BlogBundle\Entity\Article $listeArticlesCree
     *
     * @return Users
     */
    public function addListeArticlesCree(\BlogBundle\Entity\Article $listeArticlesCree)
    {
        $this->listeArticlesCrees[] = $listeArticlesCree;

        return $this;
    }

    /**
     * Remove listeArticlesCree
     *
     * @param \BlogBundle\Entity\Article $listeArticlesCree
     */
    public function removeListeArticlesCree(\BlogBundle\Entity\Article $listeArticlesCree)
    {
        $this->listeArticlesCrees->removeElement($listeArticlesCree);
    }

    /**
     * Get listeArticlesCrees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListeArticlesCrees()
    {
        return $this->listeArticlesCrees;
    }
}
