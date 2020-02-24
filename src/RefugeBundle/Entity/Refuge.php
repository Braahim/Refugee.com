<?php

namespace RefugeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Refuge
 *
 * @ORM\Table(name="refuge")
 * @ORM\Entity(repositoryClass="RefugeBundle\Repository\RefugeRepository")
 */
class Refuge
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
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Za-z]$/", message="saisie une chaine de charactere")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Za-z]$/", message="saisie une chaine de charactere")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Za-z]$/", message="saisie une chaine de charactere")
     */
    private $nationalite;

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @var string
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"})
     * @Assert\NotBlank(message="plz enter an image")
     * @Assert\Image()
     * @ORM\Column(name="img",type="string",length=255,nullable=true)
     */
    private $img;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="addDate", type="datetime", nullable=true)
     */
    private $currentDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthD", type="date")
     */
    private $birthD;

    /**
     * @var string
     *
     * @ORM\Column(name="birthLoc", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Za-z]$/", message="saisie une chaine de charactere")
     */
    private $birthLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Za-z]$/", message="saisie une chaine de charactere")
     */
    private $sexe;

    /**
     * @ORM\ManyToOne(targetEntity="camp")
     * @ORM\JoinColumn(name="camp", referencedColumnName="id",onDelete="CASCADE")
     */
    private $camp;

    /**
     * @var string
     *
     * @ORM\Column(name="socialSit", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Za-z]$/", message="saisie une chaine de charactere")
     */
    private $socialSit;

    /**
     * @return mixed
     */
    public function getEntreprise()
    {
        return $this->Entreprise;
    }

    /**
     * @param mixed $Entreprise
     */
    public function setEntreprise($Entreprise)
    {
        $this->Entreprise = $Entreprise;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Entreprise")
     * @ORM\JoinColumn(name="Entreprise_id",referencedColumnName="id")
     */
    private $Entreprise;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Refuge
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Refuge
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Refuge
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set birthD
     *
     * @param \DateTime $birthD
     *
     * @return Refuge
     */
    public function setBirthD($birthD)
    {
        $this->birthD = $birthD;

        return $this;
    }

    /**
     * Get birthD
     *
     * @return \DateTime
     */
    public function getBirthD()
    {
        return $this->birthD;
    }

    /**
     * Set birthLoc
     *
     * @param string $birthLoc
     *
     * @return Refuge
     */
    public function setBirthLoc($birthLoc)
    {
        $this->birthLoc = $birthLoc;

        return $this;
    }

    /**
     * Get birthLoc
     *
     * @return string
     */
    public function getBirthLoc()
    {
        return $this->birthLoc;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Refuge
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set socialSit
     *
     * @param string $socialSit
     *
     * @return Refuge
     */
    public function setSocialSit($socialSit)
    {
        $this->socialSit = $socialSit;

        return $this;
    }

    /**
     * Get socialSit
     *
     * @return string
     */
    public function getSocialSit()
    {
        return $this->socialSit;
    }

    /**
     * @return \DateTime
     */
    public function getCurrentDate()
    {
        return $this->currentDate;
    }

    /**
     * @param \DateTime $currentDate
     *
     */
    public function setCurrentDate($currentDate)
    {
        $this->currentDate = $currentDate;
    }

    /**
     * @return mixed
     */
    public function getCamp()
    {
        return $this->camp;
    }

    /**
     * @param mixed $camp
     */
    public function setCamp($camp)
    {
        $this->camp = $camp;
    }


}

