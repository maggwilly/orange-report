<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PointVente
 *
 * @ORM\Table(name="point_vente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PointVenteRepository")
 */
class PointVente
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
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;


   /**
     * @var string
     * @ORM\Column(name="secteur", type="string", length=255,nullable=true)
     */
    private $secteur;

       /**
     * @var string
     * @ORM\Column(name="nom_secteur", type="string", length=255,nullable=true)
     */
    private $nomSecteur;
        /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="pointVentes")
     * @var User
     */
    private $user;

        /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commende", mappedBy="pointVente", cascade={"persist","remove"})
   */
    private $commendes;



    public function __construct(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;
    }
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
     * @return PointVente
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
     * Set telephone
     *
     * @param string $telephone
     *
     * @return PointVente
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return PointVente
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set secteur
     *
     * @param string $secteur
     *
     * @return User
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur
     *
     * @return string
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set nomSecteur
     *
     * @param string $nomSecteur
     *
     * @return PointVente
     */
    public function setNomSecteur($nomSecteur)
    {
        $this->nomSecteur = $nomSecteur;

        return $this;
    }

    /**
     * Get nomSecteur
     *
     * @return string
     */
    public function getNomSecteur()
    {
        return $this->nomSecteur;
    }

    /**
     * Add commende
     *
     * @param \AppBundle\Entity\Commende $commende
     *
     * @return PointVente
     */
    public function addCommende(\AppBundle\Entity\Commende $commende)
    {
        $this->commendes[] = $commende;

        return $this;
    }

    /**
     * Remove commende
     *
     * @param \AppBundle\Entity\Commende $commende
     */
    public function removeCommende(\AppBundle\Entity\Commende $commende)
    {
        $this->commendes->removeElement($commende);
    }

    /**
     * Get commendes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommendes()
    {
        return $this->commendes;
    }
}