<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={
 *     @ORM\Index(name="FK_produit_idCategorie", columns={"id_categorie"})
 * })
 * @ORM\Entity
 */

class Produit
{
    /**
     * @var int
     *
     * @ORM\column(name="id_produit", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    //attributs
    /**
     * @var string
     *
     * @ORM\column(name="libelle", type="string", length=100, nullable=false)
     */
    private $libelleProduit;

    /**
     * @var string
     *
     * @ORM\column(name="prix_unitaire_ht", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $prixUnitaireHT;

    /**
     * @var string
     *
     * @ORM\column(name="reference", type="string", length=255, nullable=false)
     */
    private $reference;

    /**
     * @var int
     *
     * @ORM\column(name="quantite_produit", type="integer", length=11, nullable=false)
     */
    private $quantiteProduit;

    /**
     * @var string|null
     *
     * @ORM\column(name="description_produit", type="string", length=1000, nullable=true)
     */
    private $descriptionProduit;


    //foreign key
    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="lesProduits")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_categorie", referencedColumnName="id_categorie")
     * })
     */
    private $categorie;


    //collection des photos correspondant a un produit
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="PhotoProduit", mappedBy="produit", fetch="EAGER")
     */
    private $lesPhotosProduit;

    //collection des commentaires correspondant a un produit
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="produit", fetch="EAGER")
     */
    private $lesCommentaires;

    //collection des avis correspondant a un produit
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Avis", mappedBy="produit")
     */
    private $lesAvis;

    //collection des lignes panier correspondant a un produit
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="LignePanier", mappedBy="produit", fetch="EAGER")
     */
    private $lesLignesPanier;

    public function __construct()
    {
        $this->lesPhotosProduit = new ArrayCollection();
        $this->lesCommentaires = new ArrayCollection();
        $this->lesAvis = new ArrayCollection();
        $this->lesLignesPanier = new ArrayCollection();
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getLibelleProduit(): ?string
    {
        return $this->libelleProduit;
    }

    public function setLibelleProduit(string $libelleProduit): self
    {
        $this->libelleProduit = $libelleProduit;

        return $this;
    }

    public function getPrixUnitaireHT()
    {
        return $this->prixUnitaireHT;
    }

    public function setPrixUnitaireHT($prixUnitaireHT): self
    {
        $this->prixUnitaireHT = $prixUnitaireHT;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getQuantiteProduit(): ?int
    {
        return $this->quantiteProduit;
    }

    public function setQuantiteProduit(int $quantiteProduit): self
    {
        $this->quantiteProduit = $quantiteProduit;

        return $this;
    }

    public function getDescriptionProduit(): ?string
    {
        return $this->descriptionProduit;
    }

    public function setDescriptionProduit(?string $descriptionProduit): self
    {
        $this->descriptionProduit = $descriptionProduit;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|PhotoProduit[]
     */
    public function getLesPhotosProduit(): Collection
    {
        return $this->lesPhotosProduit;
    }

    public function addLesPhotosProduit(PhotoProduit $lesPhotosProduit): self
    {
        if (!$this->lesPhotosProduit->contains($lesPhotosProduit)) {
            $this->lesPhotosProduit[] = $lesPhotosProduit;
            $lesPhotosProduit->setProduit($this);
        }

        return $this;
    }

    public function removeLesPhotosProduit(PhotoProduit $lesPhotosProduit): self
    {
        if ($this->lesPhotosProduit->contains($lesPhotosProduit)) {
            $this->lesPhotosProduit->removeElement($lesPhotosProduit);
            // set the owning side to null (unless already changed)
            if ($lesPhotosProduit->getProduit() === $this) {
                $lesPhotosProduit->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getLesCommentaires(): Collection
    {
        return $this->lesCommentaires;
    }

    public function addLesCommentaire(Commentaire $lesCommentaire): self
    {
        if (!$this->lesCommentaires->contains($lesCommentaire)) {
            $this->lesCommentaires[] = $lesCommentaire;
            $lesCommentaire->setProduit($this);
        }

        return $this;
    }

    public function removeLesCommentaire(Commentaire $lesCommentaire): self
    {
        if ($this->lesCommentaires->contains($lesCommentaire)) {
            $this->lesCommentaires->removeElement($lesCommentaire);
            // set the owning side to null (unless already changed)
            if ($lesCommentaire->getProduit() === $this) {
                $lesCommentaire->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getLesAvis(): Collection
    {
        return $this->lesAvis;
    }

    public function addLesAvi(Avis $lesAvi): self
    {
        if (!$this->lesAvis->contains($lesAvi)) {
            $this->lesAvis[] = $lesAvi;
            $lesAvi->setProduit($this);
        }

        return $this;
    }

    public function removeLesAvi(Avis $lesAvi): self
    {
        if ($this->lesAvis->contains($lesAvi)) {
            $this->lesAvis->removeElement($lesAvi);
            // set the owning side to null (unless already changed)
            if ($lesAvi->getProduit() === $this) {
                $lesAvi->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LignePanier[]
     */
    public function getLesLignesPanier(): Collection
    {
        return $this->lesLignesPanier;
    }

    public function addLesLignesPanier(LignePanier $lesLignesPanier): self
    {
        if (!$this->lesLignesPanier->contains($lesLignesPanier)) {
            $this->lesLignesPanier[] = $lesLignesPanier;
            $lesLignesPanier->setProduit($this);
        }

        return $this;
    }

    public function removeLesLignesPanier(LignePanier $lesLignesPanier): self
    {
        if ($this->lesLignesPanier->contains($lesLignesPanier)) {
            $this->lesLignesPanier->removeElement($lesLignesPanier);
            // set the owning side to null (unless already changed)
            if ($lesLignesPanier->getProduit() === $this) {
                $lesLignesPanier->setProduit(null);
            }
        }

        return $this;
    }

}