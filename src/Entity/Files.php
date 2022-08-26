<?php

namespace App\Entity;

use App\Repository\FilesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilesRepository::class)]
class Files
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_projet = null;

    #[ORM\Column(length: 255)]
    private ?string $entrepreneur = null;

    #[ORM\Column(length: 255)]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    private ?string $profession = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_lancement = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $motivation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $principaux_interet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $activites = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cible = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fournisseur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $concurent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $strategie_commercial = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objectif_commerciaux = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $partie_prenante = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coup_investissement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capital_social = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $credit_a_solicite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $benefice_escompte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nb_employer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $apport_personnel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $delai_retour_investissement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quantite_produit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rentabilite_prevu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $forme_juridique = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $information_complementaire = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreProjet(): ?string
    {
        return $this->titre_projet;
    }

    public function setTitreProjet(string $titre_projet): self
    {
        $this->titre_projet = $titre_projet;

        return $this;
    }

    public function getEntrepreneur(): ?string
    {
        return $this->entrepreneur;
    }

    public function setEntrepreneur(string $entrepreneur): self
    {
        $this->entrepreneur = $entrepreneur;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getDateLancement(): ?\DateTimeInterface
    {
        return $this->date_lancement;
    }

    public function setDateLancement(\DateTimeInterface $date_lancement): self
    {
        $this->date_lancement = $date_lancement;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

    public function getPrincipauxInteret(): ?string
    {
        return $this->principaux_interet;
    }

    public function setPrincipauxInteret(?string $principaux_interet): self
    {
        $this->principaux_interet = $principaux_interet;

        return $this;
    }

    public function getActivites(): ?string
    {
        return $this->activites;
    }

    public function setActivites(?string $activites): self
    {
        $this->activites = $activites;

        return $this;
    }

    public function getCible(): ?string
    {
        return $this->cible;
    }

    public function setCible(?string $cible): self
    {
        $this->cible = $cible;

        return $this;
    }

    public function getFournisseur(): ?string
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?string $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getConcurent(): ?string
    {
        return $this->concurent;
    }

    public function setConcurent(?string $concurent): self
    {
        $this->concurent = $concurent;

        return $this;
    }

    public function getStrategieCommercial(): ?string
    {
        return $this->strategie_commercial;
    }

    public function setStrategieCommercial(?string $strategie_commercial): self
    {
        $this->strategie_commercial = $strategie_commercial;

        return $this;
    }

    public function getObjectifCommerciaux(): ?string
    {
        return $this->objectif_commerciaux;
    }

    public function setObjectifCommerciaux(?string $objectif_commerciaux): self
    {
        $this->objectif_commerciaux = $objectif_commerciaux;

        return $this;
    }

    public function getPartiePrenante(): ?string
    {
        return $this->partie_prenante;
    }

    public function setPartiePrenante(?string $partie_prenante): self
    {
        $this->partie_prenante = $partie_prenante;

        return $this;
    }

    public function getCoupInvestissement(): ?string
    {
        return $this->coup_investissement;
    }

    public function setCoupInvestissement(?string $coup_investissement): self
    {
        $this->coup_investissement = $coup_investissement;

        return $this;
    }

    public function getCapitalSocial(): ?string
    {
        return $this->capital_social;
    }

    public function setCapitalSocial(?string $capital_social): self
    {
        $this->capital_social = $capital_social;

        return $this;
    }

    public function getCreditASolicite(): ?string
    {
        return $this->credit_a_solicite;
    }

    public function setCreditASolicite(?string $credit_a_solicite): self
    {
        $this->credit_a_solicite = $credit_a_solicite;

        return $this;
    }

    public function getBeneficeEscompte(): ?string
    {
        return $this->benefice_escompte;
    }

    public function setBeneficeEscompte(?string $benefice_escompte): self
    {
        $this->benefice_escompte = $benefice_escompte;

        return $this;
    }

    public function getNbEmployer(): ?string
    {
        return $this->nb_employer;
    }

    public function setNbEmployer(?string $nb_employer): self
    {
        $this->nb_employer = $nb_employer;

        return $this;
    }

    public function getApportPersonnel(): ?string
    {
        return $this->apport_personnel;
    }

    public function setApportPersonnel(?string $apport_personnel): self
    {
        $this->apport_personnel = $apport_personnel;

        return $this;
    }

    public function getDelaiRetourInvestissement(): ?string
    {
        return $this->delai_retour_investissement;
    }

    public function setDelaiRetourInvestissement(?string $delai_retour_investissement): self
    {
        $this->delai_retour_investissement = $delai_retour_investissement;

        return $this;
    }

    public function getQuantiteProduit(): ?string
    {
        return $this->quantite_produit;
    }

    public function setQuantiteProduit(?string $quantite_produit): self
    {
        $this->quantite_produit = $quantite_produit;

        return $this;
    }

    public function getRentabilitePrevu(): ?string
    {
        return $this->rentabilite_prevu;
    }

    public function setRentabilitePrevu(?string $rentabilite_prevu): self
    {
        $this->rentabilite_prevu = $rentabilite_prevu;

        return $this;
    }

    public function getFormeJuridique(): ?string
    {
        return $this->forme_juridique;
    }

    public function setFormeJuridique(?string $forme_juridique): self
    {
        $this->forme_juridique = $forme_juridique;

        return $this;
    }

    public function getInformationComplementaire(): ?string
    {
        return $this->information_complementaire;
    }

    public function setInformationComplementaire(?string $information_complementaire): self
    {
        $this->information_complementaire = $information_complementaire;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeImmutable $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }
}
