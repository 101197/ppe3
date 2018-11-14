<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClient;

    //attributs
    /**
     * @var string
     *
     * @ORM\column(name="identifiant", type="string", length=20, nullable=false)
     */
    private $identifiant;

    /**
     * @var string
     *
     * @ORM\column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\column(name="mot_de_passe", type="string", length=50, nullable=false)
     */
    private $motDePasse;

    /**
     * @var string|null
     *
     * @ORM\column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\column(name="telephone", type="string", length=13, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\column(name="avatar_url", type="string", length=25, nullable=false)
     */
    private $avatarURL;

    /**
     * @var \DateTime
     *
     * @ORM\column(name="date_creation", type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     * @var bool
     *
     * @ORM\column(name="confirme", type="boolean", length=1, nullable=false)
     */
    private $confirme;

    /**
     * @var string
     *
     * @ORM\column(name="token", type="string", length=1, nullable=false)
     */
    private $token;


    //collection des commandes correspondant a un client
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Commande", mappedBy="client")
     */
    private $lesCommandes;

    //collection des avis correspondant a un client
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Avis", mappedBy="client")
     */
    private $lesAvis;

    //collection des commentaires correspondant a un client
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="client")
     */
    private $lesCommentaires;

    //collection des adresses correspondant a un client
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Adresse", mappedBy="client")
     */
    private  $lesAdresses;

    //collection des lignes panier correspondant a un client
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="LignePanier", mappedBy="client")
     */
    private $lesLignesPanier;

    public function __construct()
    {
        $this->lesCommandes = new ArrayCollection();
        $this->lesAvis = new ArrayCollection();
        $this->lesCommentaires = new ArrayCollection();
        $this->lesAdresses = new ArrayCollection();
        $this->lesLignesPanier = new ArrayCollection();
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAvatarURL(): ?string
    {
        return $this->avatarURL;
    }

    public function setAvatarURL(string $avatarURL): self
    {
        $this->avatarURL = $avatarURL;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getConfirme(): ?bool
    {
        return $this->confirme;
    }

    public function setConfirme(bool $confirme): self
    {
        $this->confirme = $confirme;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

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
            $lesCommande->setClient($this);
        }

        return $this;
    }

    public function removeLesCommande(Commande $lesCommande): self
    {
        if ($this->lesCommandes->contains($lesCommande)) {
            $this->lesCommandes->removeElement($lesCommande);
            // set the owning side to null (unless already changed)
            if ($lesCommande->getClient() === $this) {
                $lesCommande->setClient(null);
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
            $lesAvi->setClient($this);
        }

        return $this;
    }

    public function removeLesAvi(Avis $lesAvi): self
    {
        if ($this->lesAvis->contains($lesAvi)) {
            $this->lesAvis->removeElement($lesAvi);
            // set the owning side to null (unless already changed)
            if ($lesAvi->getClient() === $this) {
                $lesAvi->setClient(null);
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
            $lesCommentaire->setClient($this);
        }

        return $this;
    }

    public function removeLesCommentaire(Commentaire $lesCommentaire): self
    {
        if ($this->lesCommentaires->contains($lesCommentaire)) {
            $this->lesCommentaires->removeElement($lesCommentaire);
            // set the owning side to null (unless already changed)
            if ($lesCommentaire->getClient() === $this) {
                $lesCommentaire->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getLesAdresses(): Collection
    {
        return $this->lesAdresses;
    }

    public function addLesAdress(Adresse $lesAdress): self
    {
        if (!$this->lesAdresses->contains($lesAdress)) {
            $this->lesAdresses[] = $lesAdress;
            $lesAdress->setClient($this);
        }

        return $this;
    }

    public function removeLesAdress(Adresse $lesAdress): self
    {
        if ($this->lesAdresses->contains($lesAdress)) {
            $this->lesAdresses->removeElement($lesAdress);
            // set the owning side to null (unless already changed)
            if ($lesAdress->getClient() === $this) {
                $lesAdress->setClient(null);
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
            $lesLignesPanier->setClient($this);
        }

        return $this;
    }

    public function removeLesLignesPanier(LignePanier $lesLignesPanier): self
    {
        if ($this->lesLignesPanier->contains($lesLignesPanier)) {
            $this->lesLignesPanier->removeElement($lesLignesPanier);
            // set the owning side to null (unless already changed)
            if ($lesLignesPanier->getClient() === $this) {
                $lesLignesPanier->setClient(null);
            }
        }

        return $this;
    }

}