<?php

namespace App\Entity;

use App\Repository\ResourceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ResourceRepository::class)]
#[UniqueEntity(fields: ['url'], message: 'Url existe deja')]
class Resource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255,unique: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreated = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateModified = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resourcePassword = null;

    #[ORM\ManyToOne(inversedBy: 'resources')]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'resource', cascade: ['persist', 'remove'])]
    private ?Link $link = null;

    #[ORM\OneToOne(mappedBy: 'resource', cascade: ['persist', 'remove'])]
    private ?Fichier $fichier = null;



    public function __construct()
    {
        $this->dateCreated = new \DateTime('now');
    }
    
    public function __toString()
    {   
        return (string) "Id: ".$this->id." Url: ".$this->url;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(): self
    {
        $this->dateModified = new \DateTime('now');

        return $this;
    }

    public function getResourcePassword(): ?string
    {
        return $this->resourcePassword;
    }

    public function setResourcePassword(?string $resourcePassword): self
    {
        $this->resourcePassword = $resourcePassword;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLink(): ?Link
    {
        return $this->link;
    }

    public function setLink(?Link $link): self
    {
        // unset the owning side of the relation if necessary
        if ($link === null && $this->link !== null) {
            $this->link->setResource(null);
        }

        // set the owning side of the relation if necessary
        if ($link !== null && $link->getResource() !== $this) {
            $link->setResource($this);
        }

        $this->link = $link;

        return $this;
    }

    public function getFichier(): ?Fichier
    {
        return $this->fichier;
    }

    public function setFichier(?Fichier $fichier): self
    {
        // unset the owning side of the relation if necessary
        if ($fichier === null && $this->fichier !== null) {
            $this->fichier->setResource(null);
        }

        // set the owning side of the relation if necessary
        if ($fichier !== null && $fichier->getResource() !== $this) {
            $fichier->setResource($this);
        }

        $this->fichier = $fichier;

        return $this;
    }

}
