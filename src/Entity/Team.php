<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'team')]
class Team
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private ?int $id;

    #[Column(type: 'string')]
    private string $name;

    #[Column(type: 'datetime', unique: true)]
    private \DateTime $foundingDate;

    #[Column(type: 'string')]
    private string $logoUrl;

    #[ManyToOne(targetEntity: League::class)]
    #[JoinColumn(name: 'league_id', referencedColumnName: 'id')]
    private League $league;

    #[ManyToMany(targetEntity: Color::class)]
    #[JoinTable(name: 'team_has_color')]
    private Collection $colors;

    public function __construct(string $name, \DateTime $foundingDate, string $logoUrl, League $league)
    {
        $this->name = $name;
        $this->foundingDate = $foundingDate;
        $this->logoUrl = $logoUrl;
        $this->league = $league;
        $this->colors = new ArrayCollection();
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'foundingDate' => $this->getFoundingDate()->format(DATE_ATOM),
            'logoUrl' => $this->getLogoUrl(),
            'league' => $this->getLeague()->toArray(),
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

    public function getFoundingDate(): \DateTime
    {
        return $this->foundingDate;
    }

    public function getLogoUrl(): string
    {
        return $this->logoUrl;
    }

    public function getLeague(): League
    {
        return $this->league;
    }

    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Color $color): Team
    {
        $this->colors->add($color);

        return $this;
    }
}
