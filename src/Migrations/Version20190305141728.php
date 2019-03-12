<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190305141728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE work_contacts_companys');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_contacts_companys (id_contact VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, id_company VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_8E516FAD92FF4F48 (id_contact), INDEX IDX_8E516FAD9122A03F (id_company), PRIMARY KEY(id_contact, id_company)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE work_contacts_companys ADD CONSTRAINT FK_8E516FAD9122A03F FOREIGN KEY (id_company) REFERENCES company (code)');
        $this->addSql('ALTER TABLE work_contacts_companys ADD CONSTRAINT FK_8E516FAD92FF4F48 FOREIGN KEY (id_contact) REFERENCES contacts (code)');
    }
}
