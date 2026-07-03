<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703150101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE battlefield (id INT AUTO_INCREMENT NOT NULL, battlefield_type VARCHAR(50) NOT NULL, expansion_pack_id INT NOT NULL, INDEX IDX_51B7F6D5C5397605 (expansion_pack_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE battlefield ADD CONSTRAINT FK_51B7F6D5C5397605 FOREIGN KEY (expansion_pack_id) REFERENCES expansion_pack (id)');
        $this->addSql('ALTER TABLE scenario ADD battlefield_id INT NOT NULL');
        $this->addSql('ALTER TABLE scenario ADD CONSTRAINT FK_3E45C8D8FAE052AE FOREIGN KEY (battlefield_id) REFERENCES battlefield (id)');
        $this->addSql('CREATE INDEX IDX_3E45C8D8FAE052AE ON scenario (battlefield_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE battlefield DROP FOREIGN KEY FK_51B7F6D5C5397605');
        $this->addSql('DROP TABLE battlefield');
        $this->addSql('ALTER TABLE scenario DROP FOREIGN KEY FK_3E45C8D8FAE052AE');
        $this->addSql('DROP INDEX IDX_3E45C8D8FAE052AE ON scenario');
        $this->addSql('ALTER TABLE scenario DROP battlefield_id');
    }
}
