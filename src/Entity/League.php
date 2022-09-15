<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'league')]
class League
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private ?int $id;

    #[Column(type: 'string', unique: true)]
    private string $name;

    #[Column(name: 'number_of_teams', type: 'integer')]
    private int $numberOfTeams;

    #[Column(name: 'logo_url', type: 'string')]
    private string $logoUrl;

    #[ManyToMany(targetEntity: Color::class)]
    #[JoinTable(name: 'league_has_color')]
    private Collection $colors;

    public function __construct(string $name, int $numberOfTeams, string $logoUrl)
    {
        $this->name = $name;
        $this->numberOfTeams = $numberOfTeams;
        $this->logoUrl = $logoUrl;
        $this->colors = new ArrayCollection();
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'numberOfTeams' => $this->getNumberOfTeams(),
            'logoUrl' => $this->getLogoUrl(),
            'colors' => $this->getColors()->map(static fn (Color $color) => $color->toArray())->getValues(),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumberOfTeams(): int
    {
        return $this->numberOfTeams;
    }

    public function getLogoUrl(): string
    {
        return $this->logoUrl;
    }

    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Color $color): League
    {
        $this->colors->add($color);

        return $this;
    }
}
