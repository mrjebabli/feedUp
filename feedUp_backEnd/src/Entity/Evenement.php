<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups ("event:read")
     * @groups ("comment:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @groups ("event:read")
     * @groups ("comment:read")
     */
    private $eid;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups ("event:read")
     * @groups ("comment:read")
    */
    private $enom;

    /**
     * @ORM\Column(type="datetime")
     * @groups ("event:read")
     * @groups ("comment:read")
     */
    private $edate;

    /**
     * @ORM\Column(type="datetime")
     * @groups ("event:read")
     * @groups ("comment:read")
     */
    private $eduree;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups ("event:read")
     * @groups ("comment:read")
     */
    private $edetails;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups ("event:read")
     * @groups ("comment:read")
     */
    private $elocation;

    /**
     * @ORM\Column(type="integer")
     * @groups ("event:read")
     * @groups ("comment:read")
     */
    private $enombre;

    
    /**
     * @ORM\ManyToMany(targetEntity=Utilisateur::class, mappedBy="relation")
     */
    private $utilisateurs;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="evenement", orphanRemoval=true)
     * 
     */
    private $commentaires;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->edate=new \DateTime();
    }
 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEid(): ?int
    {
        return $this->eid;
    }

    public function setEid(int $eid): self
    {
        $this->eid = $eid;

        return $this;
    }

    public function getEnom(): ?string
    {
        return $this->enom;
    }

    public function setEnom(string $enom): self
    {
        $this->enom = $enom;

        return $this;
    }

    public function getEdate(): ?\Datetime
    {
        return $this->edate;
    }

    public function setEdate(\Datetime  $edate): self
    {
        $this->edate = $edate;

        return $this;
    }

    public function getEduree(): ?\Datetime
    {
        return $this->eduree;
    }

    public function setEduree(\Datetime $eduree): self
    {
        $this->eduree = $eduree;

        return $this;
    }

    public function getEdetails(): ?string
    {
        return $this->edetails;
    }

    public function setEdetails(string $edetails): self
    {
        $this->edetails = $edetails;

        return $this;
    }

    public function getElocation(): ?string
    {
        return $this->elocation;
    }

    public function setElocation(string $elocation): self
    {
        $this->elocation = $elocation;

        return $this;
    }

    public function getEnombre(): ?int
    {
        return $this->enombre;
    }

    public function setEnombre(int $enombre): self
    {
        $this->enombre = $enombre;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->addRelation($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            $utilisateur->removeRelation($this);
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setEvenement($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getEvenement() === $this) {
                $commentaire->setEvenement(null);
            }
        }

        return $this;
    }

  
}
