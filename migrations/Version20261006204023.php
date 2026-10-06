<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261006204023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) NOT NULL, design_id INT DEFAULT NULL, component_id INT DEFAULT NULL, battlefield_id INT DEFAULT NULL, scenario_id INT DEFAULT NULL, INDEX IDX_16DB4F89E41DC9B2 (design_id), INDEX IDX_16DB4F89E2ABAFFF (component_id), INDEX IDX_16DB4F89FAE052AE (battlefield_id), UNIQUE INDEX UNIQ_16DB4F89E04E49DF (scenario_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89E41DC9B2 FOREIGN KEY (design_id) REFERENCES expansion_pack (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89FAE052AE FOREIGN KEY (battlefield_id) REFERENCES battlefield (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89E04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id)');
        $this->addSql('ALTER TABLE expansion_pack CHANGE expansion_pack_icon expansion_pack_icon LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89E41DC9B2');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89E2ABAFFF');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89FAE052AE');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89E04E49DF');
        $this->addSql('DROP TABLE picture');
        $this->addSql('ALTER TABLE expansion_pack CHANGE expansion_pack_icon expansion_pack_icon LONGTEXT DEFAULT NULL');
    }
}
