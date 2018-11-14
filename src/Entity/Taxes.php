<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Taxes
 *
 * @ORM\Table(name="taxes")
 * @ORM\Entity
 */

class Taxes
{
    /**
     * @var int
     *
     * @ORM\column(name="id_taux_taxe", type="integer", nullable=false)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTauxTaxe;

    //attributs
    /**
     * @var string
     *
     * @ORM\column(name="taux", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $taux;

    public function getIdTauxTaxe(): ?int
    {
        return $this->idTauxTaxe;
    }

    public function getTaux()
    {
        return $this->taux;
    }

    public function setTaux($taux): self
    {
        $this->taux = $taux;

        return $this;
    }

}