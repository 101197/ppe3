<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * PhotoProduit
 *
 * @ORM\Table(name="photo_produit", indexes={
 *     @ORM\Index(name="FK_photo_produit_idProduit", columns={"id_produit"})
 * })
 * @ORM\Entity
 */

class PhotoProduit
{
    /**
     * @var int
     *
     * @ORM\column(name="id_photo_produit", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPhotoProduit;

    /**
     * @var string|null
     *
     * @ORM\column(name="nom_image", type="string", length=100, nullable=true)
     */
    private $nomImage;


    //foreign key
    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="lesPhotosProduit")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     * })
     */
    private $produit;

    public function getIdPhotoProduit(): ?int
    {
        return $this->idPhotoProduit;
    }

    public function getNomImage(): ?string
    {
        return $this->nomImage;
    }

    public function setNomImage(?string $nomImage): self
    {
        $this->nomImage = $nomImage;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

}