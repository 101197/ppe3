<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={
 *     @ORM\Index(name="FK_avis_idClient", columns={"id_client"}),
 *     @ORM\Index(name="FK_avis_idProduit", columns={"id_produit"})
 * })
 * @ORM\Entity
 */

class Avis
{
    /**
     * @var int
     *
     * @ORM\column(name="id_avis", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAvis;

    //attributs
    /**
     * @var \DateTime
     *
     * @ORM\column(name="date_avis", type="datetime", nullable=false)
     */
    private $dateAvis;

    /**
     * @var int
     *
     * @ORM\column(name="valeur", type="string", nullable=false)
     */
    private $valeur;


    //foreign key
    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="lesAvis")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $client;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="lesAvis")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     * })
     */
    private $produit;

    public function getIdAvis(): ?int
    {
        return $this->idAvis;
    }

    public function getDateAvis(): ?\DateTimeInterface
    {
        return $this->dateAvis;
    }

    public function setDateAvis(\DateTimeInterface $dateAvis): self
    {
        $this->dateAvis = $dateAvis;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self
    {
        $this->valeur = $valeur;

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