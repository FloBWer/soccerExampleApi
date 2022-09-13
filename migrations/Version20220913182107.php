<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220913182107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_665648E95E237E06 (name), UNIQUE INDEX UNIQ_665648E977153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number_of_teams INT NOT NULL, logo_url VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3EB4C3185E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE league_has_color (league_id INT NOT NULL, color_id INT NOT NULL, INDEX IDX_CF90018958AFC4DE (league_id), INDEX IDX_CF9001897ADA1FB5 (color_id), PRIMARY KEY(league_id, color_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, position_id INT DEFAULT NULL, number INT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birth_date DATETIME NOT NULL, number_of_games INT NOT NULL, number_of_goals INT NOT NULL, picture_url VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_98197A6596901F54 (number), INDEX IDX_98197A65296CD8AE (team_id), INDEX IDX_98197A65DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_462CE4F53EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, league_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, founding_date DATETIME NOT NULL, logo_url VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C4E0A61F8A35A914 (founding_date), INDEX IDX_C4E0A61F58AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_has_color (team_id INT NOT NULL, color_id INT NOT NULL, INDEX IDX_2ADA46B0296CD8AE (team_id), INDEX IDX_2ADA46B07ADA1FB5 (color_id), PRIMARY KEY(team_id, color_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE league_has_color ADD CONSTRAINT FK_CF90018958AFC4DE FOREIGN KEY (league_id) REFERENCES league (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE league_has_color ADD CONSTRAINT FK_CF9001897ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE team_has_color ADD CONSTRAINT FK_2ADA46B0296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_has_color ADD CONSTRAINT FK_2ADA46B07ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE league_has_color DROP FOREIGN KEY FK_CF90018958AFC4DE');
        $this->addSql('ALTER TABLE league_has_color DROP FOREIGN KEY FK_CF9001897ADA1FB5');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65296CD8AE');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65DD842E46');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F58AFC4DE');
        $this->addSql('ALTER TABLE team_has_color DROP FOREIGN KEY FK_2ADA46B0296CD8AE');
        $this->addSql('ALTER TABLE team_has_color DROP FOREIGN KEY FK_2ADA46B07ADA1FB5');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE league_has_color');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_has_color');
    }
}
