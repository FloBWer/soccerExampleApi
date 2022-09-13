<?php declare(strict_types=1);

namespace App\Entity;

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
    private int $id;

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
}
