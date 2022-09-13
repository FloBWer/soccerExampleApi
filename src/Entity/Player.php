<?php declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'player')]
class Player
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'integer', unique: true)]
    private int $number;

    #[Column(name: 'last_name', type: 'string')]
    private string $lastName;

    #[Column(name: 'first_name', type: 'string')]
    private string $firstName;

    #[Column(name: 'birth_date', type: 'datetime')]
    private DateTime $birthDate;

    #[Column(name: 'number_of_games', type: 'integer')]
    private int $numberOfGames;

    #[Column(name: 'number_of_goals', type: 'integer')]
    private int $numberOfGoals;

    #[Column(name: 'picture_url', type: 'string')]
    private string $pictureUrl;

    #[ManyToOne(targetEntity: Team::class)]
    #[JoinColumn(name: 'team_id', referencedColumnName: 'id')]
    private Team $team;

    #[ManyToOne(targetEntity: Position::class)]
    #[JoinColumn(name: 'position_id', referencedColumnName: 'id')]
    private Position $position;
}
