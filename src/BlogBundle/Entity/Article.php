<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime")
     */
    private $dateModification;

    /**
     * @var string
     *
     * @ORM\Column(name="article", type="text")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Users", inversedBy= "listeArticlesCrees")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $auteur;

    /**
     * @ORM\OrderBy({"dateCreation" = "DESC"})
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Commentaires", mappedBy="article" , cascade={"remove"})
     */
    private $listeAvis;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Article
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Article
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set article
     *
     * @param string $article
     *
     * @return Article
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set auteur
     *
     * @param \BlogBundle\Entity\Users $auteur
     *
     * @return Article
     */
    public function setAuteur(\BlogBundle\Entity\Users $auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \BlogBundle\Entity\Users
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listeAvis = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listeAvi
     *
     * @param \BlogBundle\Entity\Commentaires $listeAvi
     *
     * @return Article
     */
    public function addListeAvi(\BlogBundle\Entity\Commentaires $listeAvi)
    {
        $this->listeAvis[] = $listeAvi;

        return $this;
    }

    /**
     * Remove listeAvi
     *
     * @param \BlogBundle\Entity\Commentaires $listeAvi
     */
    public function removeListeAvi(\BlogBundle\Entity\Commentaires $listeAvi)
    {
        $this->listeAvis->removeElement($listeAvi);
    }

    /**
     * Get listeAvis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListeAvis()
    {
        return $this->listeAvis;
    }
}
