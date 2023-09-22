<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use App\Repository\ReccurencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert; // Symfony's built-in constraints
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;

#[ORM\Entity(repositoryClass: ReccurencyRepository::class)]
#[ApiResource]
#[ApiResource(
    normalizationContext: ['groups' => ['read'], 'enable_max_depth' => true],
    uriTemplate: '/events/{eventId}/reccurent',
    uriVariables: [
        'eventId' => new Link(fromClass: Event::class, fromProperty: 'reccurence'),
    ],
    operations: [
        new Get()
    ]
)]
#[ApiFilter(DateFilter::class, properties: ['until'])]
class Reccurency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    #[Groups(['read'])]
    private ?\DateTimeInterface $until = null;

    #[ORM\ManyToOne(inversedBy: 'reccurence')]
    #[Groups(['read'])]
    private ?Event $event = null;

    #[ORM\ManyToOne(inversedBy: 'reccurence')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read'])]
    private ?Frequencies $frequencies = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUntil(): ?\DateTimeInterface
    {
        return $this->until;
    }

    public function setUntil(?\DateTimeInterface $until): static
    {
        $this->until = $until;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getFrequencies(): ?Frequencies
    {
        return $this->frequencies;
    }

    public function setFrequencies(?Frequencies $frequencies): static
    {
        $this->frequencies = $frequencies;

        return $this;
    }
}
