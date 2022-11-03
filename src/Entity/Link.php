<?php
// 
namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Resource;


#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $inputLink = null;

    #[ORM\OneToOne(inversedBy: 'link', cascade: ['persist', 'remove'])]
    private ?Resource $resource = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInputLink(): ?string
    {
        return $this->inputLink;
    }

    public function setInputLink(string $inputLink): self
    {
        $this->inputLink = $inputLink;

        return $this;
    }

    public function getResource(): ?Resource
    {
        return $this->resource;
    }

    public function setResource(?Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

}
