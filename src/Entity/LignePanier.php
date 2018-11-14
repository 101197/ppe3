<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * LignePanier
 *
 * @ORM\Table(name="ligne_panier", indexes={
 *     @ORM\Index(name="FK_ligne_panier_idClient", columns={"id_client"}),
 *     @ORM\Index(name="FK_ligne_panier_idProduit", columns={"id_produit"})
 * })
 * @ORM\Entity
 */

class LignePanier
{
    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    //foreign key
    /**
     * @var \Client
     *
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="lesLignesPanier")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $client;

    /**
     * @var \Produit
     *
     * @ORM\Id
     *
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="lesLignesPanier")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     * })
     */
    private $produit;

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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