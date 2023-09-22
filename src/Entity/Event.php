<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert; // Symfony's built-in constraints
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[UniqueEntity(
    fields:['start'],
    message:"dates.already_booked"
)]
#[UniqueEntity(
    fields:['end'],
    message:"dates.already_booked"
)]
#[ApiResource]
#[ApiFilter(DateFilter::class, properties: ['start','end'])]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "field.can_not_be_null")]
    #[Groups(['read'])]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    #[Groups(['read'])]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    #[Groups(['read'])]
    private ?\DateTimeInterface $end = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Reccurency::class, orphanRemoval:true)]
    private Collection $reccurence;

    public function __construct()
    {
        $this->reccurence = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(?\DateTimeInterface $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): static
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return Collection<int, Reccurency>
     */
    public function getReccurence(): Collection
    {
        return $this->reccurence;
    }

    public function addReccurence(Reccurency $reccurence): static
    {
        if (!$this->reccurence->contains($reccurence)) {
            $this->reccurence->add($reccurence);
            $reccurence->setEvent($this);
        }

        return $this;
    }

    public function removeReccurence(Reccurency $reccurence): static
    {
        if ($this->reccurence->removeElement($reccurence)) {
            // set the owning side to null (unless already changed)
            if ($reccurence->getEvent() === $this) {
                $reccurence->setEvent(null);
            }
        }

        return $this;
    }
}
