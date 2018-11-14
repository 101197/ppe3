<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={
 *     @ORM\Index(name="FK_commande_idClient", columns={"id_client"}),
 *     @ORM\Index(name="FK_commande_idAdresse", columns={"id_adresse"})
 * })
 * @ORM\Entity
 */
class Commande
{
    //id
    /**
     * @var int
     *
     * @ORM\column(name="id_commande", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommande;

    //attributs
    /**
     * @var \DateTime
     *
     * @ORM\column(name="date_commande", type="datetime", nullable=false)
     */
    private $dateCommande;

    /**
     * @var string|null
     *
     * @ORM\column(name="total_ht", type="decimal", nullable=true)
     */
    private $totalHT;

    /**
     * @var string|null
     *
     * @ORM\column(name="frais_port_ht", type="decimal", nullable=true)
     */
    private $fraisPortHT;

    /**
     * @var string
     *
     * @ORM\column(name="taxe_moment_commande", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $TaxeMomentCommande;


    //foreign key
    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="lesCommandes")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $client;

    /**
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse", inversedBy="lesCommandes")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_adresse", referencedColumnName="id_adresse")
     * })
     */
    private $adresse;

    public function getIdCommande(): ?int
    {
        return $this->idCommande;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getTotalHT()
    {
        return $this->totalHT;
    }

    public function setTotalHT($totalHT): self
    {
        $this->totalHT = $totalHT;

        return $this;
    }

    public function getFraisPortHT()
    {
        return $this->fraisPortHT;
    }

    public function setFraisPortHT($fraisPortHT): self
    {
        $this->fraisPortHT = $fraisPortHT;

        return $this;
    }

    public function getTaxeMomentCommande()
    {
        return $this->TaxeMomentCommande;
    }

    public function setTaxeMomentCommande($TaxeMomentCommande): self
    {
        $this->TaxeMomentCommande = $TaxeMomentCommande;

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

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }


}