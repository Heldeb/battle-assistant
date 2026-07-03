<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703153147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component ADD subcategory VARCHAR(50) NOT NULL, ADD movement_rules LONGTEXT NOT NULL, ADD attack_rules LONGTEXT NOT NULL, ADD protection_rules LONGTEXT NOT NULL, ADD line_of_sight_rules LONGTEXT NOT NULL, ADD component_icon LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component DROP subcategory, DROP movement_rules, DROP attack_rules, DROP protection_rules, DROP line_of_sight_rules, DROP component_icon');
    }
}
