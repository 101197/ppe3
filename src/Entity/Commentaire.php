<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={
 *     @ORM\Index(name="FK_commentaire_idClient", columns={"id_client"}),
 *     @ORM\Index(name="FK_commentaire_idProduit", columns={"id_produit"})
 * })
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\column(name="id_commentaire", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaire;

    //attributs
    /**
     * @var \DateTime
     *
     * @ORM\column(name="date_commentaire", type="datetime", nullable=false)
     */
    private $dateCommentaire;

    /**
     * @var string
     *
     * @ORM\column(name="titre_commentaire", type="string", length=100, nullable=false)
     */
    private $titreCommentaire;

    /**
     * @var string
     *
     * @ORM\column(name="contenu_commentaire", type="string", length=1000, nullable=false)
     */
    private $contenuCommentaire;


    //foreign key
    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="lesCommentaires")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $client;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="lesCommentaires")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     * })
     */
    private $produit;

    public function getIdCommentaire(): ?int
    {
        return $this->idCommentaire;
    }

    public function getDateCommentaire(): ?\DateTimeInterface
    {
        return $this->dateCommentaire;
    }

    public function setDateCommentaire(\DateTimeInterface $dateCommentaire): self
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    public function getTitreCommentaire(): ?string
    {
        return $this->titreCommentaire;
    }

    public function setTitreCommentaire(string $titreCommentaire): self
    {
        $this->titreCommentaire = $titreCommentaire;

        return $this;
    }

    public function getContenuCommentaire(): ?string
    {
        return $this->contenuCommentaire;
    }

    public function setContenuCommentaire(string $contenuCommentaire): self
    {
        $this->contenuCommentaire = $contenuCommentaire;

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