<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\DBAL\Schema\Column;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use App\Entity\Race;
use App\Entity\User;
use App\Entity\Classe;
use App\Entity\Background;



#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?Race $race = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?Classe $classe = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?Background $background = null;

    #[Vich\UploadableField(mapping: 'Images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getBackground(): ?Background
    {
        return $this->background;
    }

    public function setBackground(?Background $background): static
    {
        $this->background = $background;

        return $this;
    }

     public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
             $this->updatedAt = new \DateTimeImmutable();
    }
    }
     public function getImageName(): ?string
    {
        return $this->imageName;

    }

    public function setImageName(?string $imageName): void
    {
    $this->imageName = $imageName;
    }
    
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
{
    $this->updatedAt = $updatedAt;
    return $this;
}

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
