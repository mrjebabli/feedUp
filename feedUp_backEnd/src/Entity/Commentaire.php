<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\CommentaireRepository;
use Symfony\Component\Serializer\Annotation\Groups;
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
     * @groups ("comment:read")
     * @groups ("event:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @groups ("comment:read")
     * @groups ("event:read")
     */
    private $cid;

    /**
     * @ORM\Column(type="datetime")
     * @groups ("comment:read")
     * @groups ("event:read")
     */
    private $cDatePublication;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups ("comment:read")
     * @groups ("event:read")
     */
    private $cContenu;



    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=true)
     */  
     private $evenement;


     public function __construct()
     {
         $this->evenement_id = 0 ;
       
     }
  

    
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
