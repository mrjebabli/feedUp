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
     */
    private $id;

    

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $enom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $edate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eduree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $edetails;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $elocation;

    /**
     * @ORM\Column(type="integer")
     */
    private $enombre;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getEdate(): ?string
    {
        return $this->edate;
    }

    public function setEdate(string  $edate): self
    {
        $this->edate = $edate;

        return $this;
    }


    public function getEduree(): ?string
    {
        return $this->eduree;
    }

    public function setEduree(string $eduree): self
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

     
}
