<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SortieRepository::class)
 */
class Sortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHeureDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateLimiteInscription;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbInscriptionsMax;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $infosSortie;

    /**
     * @ORM\ManyToOne(targetEntity=Sortie::class, inversedBy="Etat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Etat;

    /**
     * @ORM\ManyToOne(targetEntity=Sortie::class, inversedBy="Lieu")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Lieu;

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->Lieu;
    }

    /**
     * @param mixed $Lieu
     */
    public function setLieu($Lieu): void
    {
        $this->Lieu = $Lieu;
    }

    public function __construct()
    {
        $this->Etat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTimeInterface $dateHeureDebut): self
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->dateLimiteInscription;
    }

    public function setDateLimiteInscription(\DateTimeInterface $dateLimiteInscription): self
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

        return $this;
    }

    public function getNbInscriptionsMax(): ?int
    {
        return $this->nbInscriptionsMax;
    }

    public function setNbInscriptionsMax(int $nbInscriptionsMax): self
    {
        $this->nbInscriptionsMax = $nbInscriptionsMax;

        return $this;
    }

    public function getInfosSortie(): ?string
    {
        return $this->infosSortie;
    }

    public function setInfosSortie(string $infosSortie): self
    {
        $this->infosSortie = $infosSortie;

        return $this;
    }

    public function getEtat(): ?self
    {
        return $this->Etat;
    }

    public function setEtat(?self $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function addEtat(self $etat): self
    {
        if (!$this->Etat->contains($etat)) {
            $this->Etat[] = $etat;
            $etat->setEtat($this);
        }

        return $this;
    }

    public function removeEtat(self $etat): self
    {
        if ($this->Etat->removeElement($etat)) {
            // set the owning side to null (unless already changed)
            if ($etat->getEtat() === $this) {
                $etat->setEtat(null);
            }
        }

        return $this;
    }

    public function getSortie(): ?Etat
    {
        return $this->Sortie;
    }

    public function setSortie(?Etat $Sortie): self
    {
        $this->Sortie = $Sortie;

        return $this;
    }
}
