<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190103201335 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact_company_function (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_company_service (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD gender_id INT DEFAULT NULL, ADD contact_company_service_id INT DEFAULT NULL, ADD contact_company_function_id INT DEFAULT NULL, DROP gender, DROP company_function, DROP company_service');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A52A278A FOREIGN KEY (contact_company_service_id) REFERENCES contact_company_service (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6382348D3FC FOREIGN KEY (contact_company_function_id) REFERENCES contact_company_function (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638708A0E0 ON contact (gender_id)');
        $this->addSql('CREATE INDEX IDX_4C62E638A52A278A ON contact (contact_company_service_id)');
        $this->addSql('CREATE INDEX IDX_4C62E6382348D3FC ON contact (contact_company_function_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6382348D3FC');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A52A278A');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638708A0E0');
        $this->addSql('DROP TABLE contact_company_function');
        $this->addSql('DROP TABLE contact_company_service');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP INDEX IDX_4C62E638708A0E0 ON contact');
        $this->addSql('DROP INDEX IDX_4C62E638A52A278A ON contact');
        $this->addSql('DROP INDEX IDX_4C62E6382348D3FC ON contact');
        $this->addSql('ALTER TABLE contact ADD gender VARCHAR(1) NOT NULL COLLATE utf8mb4_unicode_ci, ADD company_function VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD company_service VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP gender_id, DROP contact_company_service_id, DROP contact_company_function_id');
    }
}
