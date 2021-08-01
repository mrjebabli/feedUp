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
     */
    private $id;

  

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cDatePublication;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cContenu;


     public function __construct()
     {
       
     }
  

    
    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCDatePublication(): ?string
    {
        return $this->cDatePublication;
    }

    public function setCDatePublication(string $cDatePublication): self
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

    
    
}
