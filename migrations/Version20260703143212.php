<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703143212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component ADD expansion_pack_id INT NOT NULL');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA157C5397605 FOREIGN KEY (expansion_pack_id) REFERENCES expansion_pack (id)');
        $this->addSql('CREATE INDEX IDX_49FEA157C5397605 ON component (expansion_pack_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component DROP FOREIGN KEY FK_49FEA157C5397605');
        $this->addSql('DROP INDEX IDX_49FEA157C5397605 ON component');
        $this->addSql('ALTER TABLE component DROP expansion_pack_id');
    }
}
