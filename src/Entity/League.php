<?php declare(strict_types=1);

namespace App\Entity;

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
}
