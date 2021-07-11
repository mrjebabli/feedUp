<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uprenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $uphone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uemail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $upassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $utype;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, inversedBy="utilisateurs")
     */
    private $relation;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, inversedBy="utilisateurs")
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="utilisateur", orphanRemoval=true)
     */
    private $experiences;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
        $this->groupe = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function setUid(int $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getUprenom(): ?string
    {
        return $this->uprenom;
    }

    public function setUprenom(string $uprenom): self
    {
        $this->uprenom = $uprenom;

        return $this;
    }

    public function getUnom(): ?string
    {
        return $this->unom;
    }

    public function setUnom(string $unom): self
    {
        $this->unom = $unom;

        return $this;
    }

    public function getUphone(): ?int
    {
        return $this->uphone;
    }

    public function setUphone(?int $uphone): self
    {
        $this->uphone = $uphone;

        return $this;
    }

    public function getUemail(): ?string
    {
        return $this->uemail;
    }

    public function setUemail(string $uemail): self
    {
        $this->uemail = $uemail;

        return $this;
    }

    public function getUpassword(): ?string
    {
        return $this->upassword;
    }

    public function setUpassword(string $upassword): self
    {
        $this->upassword = $upassword;

        return $this;
    }

    public function getUtype(): ?string
    {
        return $this->utype;
    }

    public function setUtype(string $utype): self
    {
        $this->utype = $utype;

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Evenement $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
        }

        return $this;
    }

    public function removeRelation(Evenement $relation): self
    {
        $this->relation->removeElement($relation);

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        $this->groupe->removeElement($groupe);

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setUtilisateur($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getUtilisateur() === $this) {
                $experience->setUtilisateur(null);
            }
        }

        return $this;
    }
}
