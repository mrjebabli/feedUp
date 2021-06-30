<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
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
    private $cid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $cDatePublication;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cContenu;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evenement;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCid(): ?int
    {
        return $this->cid;
    }

    public function setCid(int $cid): self
    {
        $this->cid = $cid;

        return $this;
    }

    public function getCDatePublication(): ?\DateTimeInterface
    {
        return $this->cDatePublication;
    }

    public function setCDatePublication(\DateTimeInterface $cDatePublication): self
    {
        $this->cDatePublication = $cDatePublication;

        return $this;
    }

    public function getCContenu(): ?string
    {
        return $this->cContenu;
    }

    public function setCContenu(string $cContenu): self
    {
        $this->cContenu = $cContenu;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    
}
