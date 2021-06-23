<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
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
}
