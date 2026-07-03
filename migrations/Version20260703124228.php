<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703124228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_name VARCHAR(50) NOT NULL, event_type VARCHAR(50) NOT NULL, event_date DATETIME NOT NULL, event_town VARCHAR(100) NOT NULL, event_contact LONGTEXT NOT NULL, event_icon LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE user_town user_town VARCHAR(100) NOT NULL, CHANGE user_icon user_icon LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE user_town user_town VARCHAR(100) DEFAULT NULL, CHANGE user_icon user_icon LONGTEXT DEFAULT NULL');
    }
}
