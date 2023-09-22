<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FrequenciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrequenciesRepository::class)]
#[ApiResource]
class Frequencies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'frequencies', targetEntity: Reccurency::class)]
    private Collection $reccurence;

    public function __construct()
    {
        $this->reccurence = new ArrayCollection();
    }

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
            $reccurence->setFrequencies($this);
        }

        return $this;
    }

    public function removeReccurence(Reccurency $reccurence): static
    {
        if ($this->reccurence->removeElement($reccurence)) {
            // set the owning side to null (unless already changed)
            if ($reccurence->getFrequencies() === $this) {
                $reccurence->setFrequencies(null);
            }
        }

        return $this;
    }
}
