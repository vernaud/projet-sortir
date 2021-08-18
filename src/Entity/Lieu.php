<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuRepository::class)
 */
class Lieu
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
     * @ORM\Column(type="string", length=50)
     */
    private $rue;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity=Ville::class, mappedBy="Lieu")
     */
    private $Ville;

    /**
     * @ORM\OneToMany(targetEntity=Lieu::class, mappedBy="Lieu")
     */
    private $Sortie;

    public function __construct()
    {
        $this->Ville = new ArrayCollection();
        $this->Sortie = new ArrayCollection();
        $this->lieu = new ArrayCollection();
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

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getVille(): Collection
    {
        return $this->Ville;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->Ville->contains($ville)) {
            $this->Ville[] = $ville;
            $ville->setLieu($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->Ville->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getLieu() === $this) {
                $ville->setLieu(null);
            }
        }

        return $this;
    }

    public function getLieu(): ?self
    {
        return $this->lieu;
    }

    public function setLieu(?self $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSortie(): Collection
    {
        return $this->Sortie;
    }

    public function addSortie(self $sortie): self
    {
        if (!$this->Sortie->contains($sortie)) {
            $this->Sortie[] = $sortie;
            $sortie->setLieu($this);
        }

        return $this;
    }

    public function removeSortie(self $sortie): self
    {
        if ($this->Sortie->removeElement($sortie)) {
            // set the owning side to null (unless already changed)
            if ($sortie->getLieu() === $this) {
                $sortie->setLieu(null);
            }
        }

        return $this;
    }

    public function setSortie(?self $Sortie): self
    {
        $this->Sortie = $Sortie;

        return $this;
    }

    public function addLieu(self $lieu): self
    {
        if (!$this->lieu->contains($lieu)) {
            $this->lieu[] = $lieu;
            $lieu->setSortie($this);
        }

        return $this;
    }

    public function removeLieu(self $lieu): self
    {
        if ($this->lieu->removeElement($lieu)) {
            // set the owning side to null (unless already changed)
            if ($lieu->getSortie() === $this) {
                $lieu->setSortie(null);
            }
        }

        return $this;
    }
}
