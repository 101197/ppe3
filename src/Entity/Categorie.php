<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */

class Categorie
{

    /**
     * @var int
     *
     * @ORM\column(name="id_categorie", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\column(name="libelle", type="string", length=100, nullable=false)
     */
    private $libelleCategorie;

    /**
     * @var string
     *
     * @ORM\column(name="nom", type="string", length=100, nullable=false)
     */
    private $nomCategorie;


    //collections produit correspondant a une categorie
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Produit", mappedBy="categorie")
     */
    private $lesProduits;

    public function __construct()
    {
        $this->lesProduits = new ArrayCollection();
    }

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function getLibelleCategorie(): ?string
    {
        return $this->libelleCategorie;
    }

    public function setLibelleCategorie(string $libelleCategorie): self
    {
        $this->libelleCategorie = $libelleCategorie;

        return $this;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getLesProduits(): Collection
    {
        return $this->lesProduits;
    }

    public function addLesProduit(Produit $lesProduit): self
    {
        if (!$this->lesProduits->contains($lesProduit)) {
            $this->lesProduits[] = $lesProduit;
            $lesProduit->setCategorie($this);
        }

        return $this;
    }

    public function removeLesProduit(Produit $lesProduit): self
    {
        if ($this->lesProduits->contains($lesProduit)) {
            $this->lesProduits->removeElement($lesProduit);
            // set the owning side to null (unless already changed)
            if ($lesProduit->getCategorie() === $this) {
                $lesProduit->setCategorie(null);
            }
        }

        return $this;
    }

}