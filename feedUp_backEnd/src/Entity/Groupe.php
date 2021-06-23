<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 */
class Groupe
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
    private $gid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gnom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gdescription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gnombre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGid(): ?int
    {
        return $this->gid;
    }

    public function setGid(int $gid): self
    {
        $this->gid = $gid;

        return $this;
    }

    public function getGnom(): ?string
    {
        return $this->gnom;
    }

    public function setGnom(string $gnom): self
    {
        $this->gnom = $gnom;

        return $this;
    }

    public function getGdescription(): ?string
    {
        return $this->gdescription;
    }

    public function setGdescription(string $gdescription): self
    {
        $this->gdescription = $gdescription;

        return $this;
    }

    public function getGnombre(): ?int
    {
        return $this->gnombre;
    }

    public function setGnombre(?int $gnombre): self
    {
        $this->gnombre = $gnombre;

        return $this;
    }
}
