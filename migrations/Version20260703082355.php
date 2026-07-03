<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703082355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scenario (id INT AUTO_INCREMENT NOT NULL, scenario_name VARCHAR(50) NOT NULL, medal_count SMALLINT NOT NULL, historical_description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(100) NOT NULL, CHANGE user_town user_town VARCHAR(100) NOT NULL, CHANGE user_icon user_icon LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE scenario');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE user_town user_town VARCHAR(100) DEFAULT NULL, CHANGE user_icon user_icon LONGTEXT DEFAULT NULL');
    }
}
