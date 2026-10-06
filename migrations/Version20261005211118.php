<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261005211118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component ADD component_subcategory VARCHAR(50) NOT NULL, ADD component_side VARCHAR(50) DEFAULT NULL, DROP subcategory, DROP side, CHANGE description component_description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE user_town user_town VARCHAR(100) NOT NULL, CHANGE user_icon user_icon LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component ADD side VARCHAR(50) DEFAULT NULL, DROP component_subcategory, CHANGE component_side subcategory VARCHAR(50) DEFAULT NULL, CHANGE component_description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE user_town user_town VARCHAR(100) DEFAULT NULL, CHANGE user_icon user_icon LONGTEXT DEFAULT NULL');
    }
}
