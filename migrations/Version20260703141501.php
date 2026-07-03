<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703141501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scenario ADD expansion_pack_id INT NOT NULL');
        $this->addSql('ALTER TABLE scenario ADD CONSTRAINT FK_3E45C8D8C5397605 FOREIGN KEY (expansion_pack_id) REFERENCES expansion_pack (id)');
        $this->addSql('CREATE INDEX IDX_3E45C8D8C5397605 ON scenario (expansion_pack_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scenario DROP FOREIGN KEY FK_3E45C8D8C5397605');
        $this->addSql('DROP INDEX IDX_3E45C8D8C5397605 ON scenario');
        $this->addSql('ALTER TABLE scenario DROP expansion_pack_id');
    }
}
