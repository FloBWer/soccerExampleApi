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
    private ?int $id;

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

    public function __construct(
        int $number,
        string $lastName,
        string $firstName,
        DateTime $birthDate,
        int $numberOfGames,
        int $numberOfGoals,
        string $pictureUrl,
        Team $team,
        Position $position
    ) {
        $this->number = $number;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthDate = $birthDate;
        $this->numberOfGames = $numberOfGames;
        $this->numberOfGoals = $numberOfGoals;
        $this->pictureUrl = $pictureUrl;
        $this->team = $team;
        $this->position = $position;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'birthDate' => $this->getBirthDate()->format(DATE_ATOM),
            'numberOfGames' => $this->getNumberOfGames(),
            'numberOfGoals' => $this->getNumberOfGoals(),
            'pictureUrl' => $this->getPictureUrl(),
            'team' => $this->getTeam()->toArray(),
            'position' => $this->getPosition()->toArray(),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    public function getNumberOfGames(): int
    {
        return $this->numberOfGames;
    }

    public function getNumberOfGoals(): int
    {
        return $this->numberOfGoals;
    }

    public function getPictureUrl(): string
    {
        return $this->pictureUrl;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }
}
