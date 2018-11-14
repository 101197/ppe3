<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", indexes={
 *     @ORM\Index(name="FK_adresse_idClient", columns={"id_client"})
 * })
 * @ORM\Entity
 */

class Adresse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_adresse", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdresse;

    //attributs
    /**
     * @var string
     *
     * @ORM\Column(name="voie", type="string", length=100, nullable=false)
     */
    private $voie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="complement", type="string", length=100, nullable=true)
     */
    private $complement;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=10, nullable=false)
     */
    private $code_postal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=false)
     */
    private $ville;


    //foreign key
    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="lesAdresses")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $client;


    //collection concernant les commande d'une adresse
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Commande", mappedBy="adresse")
     */
    private $lesCommandes;

    public function __construct()
    {
        $this->lesCommandes = new ArrayCollection();
    }

    public function getIdAdresse(): ?int
    {
        return $this->idAdresse;
    }

    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(string $voie): self
    {
        $this->voie = $voie;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(?string $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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

    /**
     * @return Collection|Commande[]
     */
    public function getLesCommandes(): Collection
    {
        return $this->lesCommandes;
    }

    public function addLesCommande(Commande $lesCommande): self
    {
        if (!$this->lesCommandes->contains($lesCommande)) {
            $this->lesCommandes[] = $lesCommande;
            $lesCommande->setAdresse($this);
        }

        return $this;
    }

    public function removeLesCommande(Commande $lesCommande): self
    {
        if ($this->lesCommandes->contains($lesCommande)) {
            $this->lesCommandes->removeElement($lesCommande);
            // set the owning side to null (unless already changed)
            if ($lesCommande->getAdresse() === $this) {
                $lesCommande->setAdresse(null);
            }
        }

        return $this;
    }



}