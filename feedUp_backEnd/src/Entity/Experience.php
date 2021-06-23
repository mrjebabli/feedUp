<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
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
    private $exid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $exDatePublication;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $exContenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExid(): ?int
    {
        return $this->exid;
    }

    public function setExid(int $exid): self
    {
        $this->exid = $exid;

        return $this;
    }

    public function getExDatePublication(): ?\DateTimeInterface
    {
        return $this->exDatePublication;
    }

    public function setExDatePublication(\DateTimeInterface $exDatePublication): self
    {
        $this->exDatePublication = $exDatePublication;

        return $this;
    }

    public function getExContenu(): ?string
    {
        return $this->exContenu;
    }

    public function setExContenu(string $exContenu): self
    {
        $this->exContenu = $exContenu;

        return $this;
    }
}
