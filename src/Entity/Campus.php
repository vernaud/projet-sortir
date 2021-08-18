<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
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
     * @ORM\OneToMany(targetEntity=Participant::class, mappedBy="campus")
     */
    private $Participant;

    public function __construct()
    {
        $this->Participant = new ArrayCollection();
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

    /**
     * @return Collection|Participant[]
     */
    public function getParticipant(): Collection
    {
        return $this->Participant;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->Participant->contains($participant)) {
            $this->Participant[] = $participant;
            $participant->setCampus($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->Participant->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getCampus() === $this) {
                $participant->setCampus(null);
            }
        }

        return $this;
    }
}
