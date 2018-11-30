<?php

//on declare le namespace
namespace App\Entity;

//on importe la librairie
use Doctrine\ORM\Mapping as ORM;


//declaration de la class/table

/**
 * ContenuCommande
 *
 * @ORM\Table(name="contenu_commande", indexes={
 *     @ORM\Index(name="FK_contenu_commande_idTauxTaxe", columns={"id_taux_taxe"}),
 *     @ORM\Index(name="FK_contenu_commande_idCommande", columns={"id_commande"}),
 *     @ORM\Index(name="FK_contenu_commande_idProduit", columns={"id_produit"})
 * })
 * @ORM\Entity
 */
class ContenuCommande
{
    //l'ID
    /**
     * @var int
     *
     * @ORM\Column(name="id_contenu_commande", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContenuCommande;

    //attributs
    /**
     * @var decimal
     *
     * @ORM\Column(name="prix_unitaireHT", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $prixUnitaireHT;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantite_Contenu", type="integer", length=11, nullable=false)
     */
    private $quantiteContenu;

    /**
     * @var decimal|null
     *
     * @ORM\Column(name="remise", type="decimal", nullable=true)
     */
    private $remise;


    //foreign key
    /**
     * @var \Taxes
     *
     * @ORM\ManyToOne(targetEntity="Taxes")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_taux_taxe", referencedColumnName="id_taux_taxe")
     * })
     */
    private $taxe;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_commande", referencedColumnName="id_commande")
     * })
     */
    private $commande;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     * })
     */
    private $produit;

    public function getIdContenuCommande(): ?int
    {
        return $this->idContenuCommande;
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

    public function getQuantiteContenu(): ?int
    {
        return $this->quantiteContenu;
    }

    public function setQuantiteContenu(int $quantiteContenu): self
    {
        $this->quantiteContenu = $quantiteContenu;

        return $this;
    }

    public function getRemise()
    {
        return $this->remise;
    }

    public function setRemise($remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getTaxes(): ?Taxes
    {
        return $this->taxe;
    }

    public function setTaxes(?Taxes $taxe): self
    {
        $this->taxe = $taxe;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

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

    public function getTaxe(): ?Taxes
    {
        return $this->taxe;
    }

    public function setTaxe(?Taxes $taxe): self
    {
        $this->taxe = $taxe;

        return $this;
    }
}