<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190222221252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activity_area (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE behavior (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (code VARCHAR(10) NOT NULL, id_activity_area INT DEFAULT NULL, id_company_category INT DEFAULT NULL, id_salesperson VARCHAR(10) DEFAULT NULL, id_legal_status INT DEFAULT NULL, id_number_employees INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, comment LONGTEXT DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, additional_address VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(5) DEFAULT NULL, town VARCHAR(255) DEFAULT NULL, phone VARCHAR(10) DEFAULT NULL, fax VARCHAR(10) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, created_at_company DATETIME DEFAULT NULL, siret VARCHAR(14) DEFAULT NULL, naf_code VARCHAR(5) DEFAULT NULL, source VARCHAR(5) DEFAULT NULL, INDEX company_legal_status2_FK (id_legal_status), INDEX company_company_category0_FK (id_company_category), INDEX id_salesperson (id_salesperson), INDEX company_activity_area_FK (id_activity_area), INDEX company_number_employees1_FK (id_number_employees), PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE last_turnovers (id_company VARCHAR(10) NOT NULL, id_turnovers INT NOT NULL, INDEX IDX_3E1F44489122A03F (id_company), INDEX IDX_3E1F4448A9E52769 (id_turnovers), PRIMARY KEY(id_company, id_turnovers)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_category (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts (code VARCHAR(10) NOT NULL, id_profession INT DEFAULT NULL, gender VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status TINYINT(1) DEFAULT NULL, decision_level CHAR(1) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, mobile_phone VARCHAR(10) DEFAULT NULL, phone VARCHAR(10) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, email_prechecked TINYINT(1) DEFAULT NULL, email_checked TINYINT(1) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, operation_source VARCHAR(255) DEFAULT NULL, comment LONGTEXT DEFAULT NULL, opt_in_newsletter TINYINT(1) DEFAULT NULL, opt_in_offres_commercial TINYINT(1) DEFAULT NULL, INDEX id_profession (id_profession), PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_contacts_companys (id_contact VARCHAR(10) NOT NULL, id_company VARCHAR(10) NOT NULL, INDEX IDX_8E516FAD92FF4F48 (id_contact), INDEX IDX_8E516FAD9122A03F (id_company), PRIMARY KEY(id_contact, id_company)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE graphic_style (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legal_status (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE number_employees (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE object_table (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operations (name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, type_operation VARCHAR(255) DEFAULT NULL, visual_headband VARCHAR(255) DEFAULT NULL, visuel_lateral VARCHAR(255) DEFAULT NULL, PRIMARY KEY(name)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_sent (id_salesperson VARCHAR(10) NOT NULL, id_operation_ VARCHAR(255) NOT NULL, id_contacts VARCHAR(10) NOT NULL, sent_at DATETIME NOT NULL, INDEX id_contacts (id_contacts), INDEX id_operation_ (id_operation_), INDEX IDX_95B4773850B241AB (id_salesperson), PRIMARY KEY(id_salesperson, id_operation_, id_contacts)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salesperson (code VARCHAR(10) NOT NULL, id_leader VARCHAR(10) DEFAULT NULL, gender VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, profile VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status TINYINT(1) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, work_name VARCHAR(255) DEFAULT NULL, mobile_phone VARCHAR(10) DEFAULT NULL, phone VARCHAR(10) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, INDEX id_leader (id_leader), PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, application_name VARCHAR(255) DEFAULT NULL, application_logo VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, additional_address VARCHAR(255) DEFAULT NULL, phone VARCHAR(10) DEFAULT NULL, fax VARCHAR(10) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, email_admin VARCHAR(255) DEFAULT NULL, email_contact VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE target (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turnovers (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F6A78379F FOREIGN KEY (id_activity_area) REFERENCES activity_area (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FFD51597D FOREIGN KEY (id_company_category) REFERENCES company_category (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F50B241AB FOREIGN KEY (id_salesperson) REFERENCES salesperson (code)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB4F7CA15 FOREIGN KEY (id_legal_status) REFERENCES legal_status (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F748A6BA9 FOREIGN KEY (id_number_employees) REFERENCES number_employees (id)');
        $this->addSql('ALTER TABLE last_turnovers ADD CONSTRAINT FK_3E1F44489122A03F FOREIGN KEY (id_company) REFERENCES company (code)');
        $this->addSql('ALTER TABLE last_turnovers ADD CONSTRAINT FK_3E1F4448A9E52769 FOREIGN KEY (id_turnovers) REFERENCES turnovers (id)');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_334015731F198DBE FOREIGN KEY (id_profession) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE work_contacts_companys ADD CONSTRAINT FK_8E516FAD92FF4F48 FOREIGN KEY (id_contact) REFERENCES contacts (code)');
        $this->addSql('ALTER TABLE work_contacts_companys ADD CONSTRAINT FK_8E516FAD9122A03F FOREIGN KEY (id_company) REFERENCES company (code)');
        $this->addSql('ALTER TABLE operation_sent ADD CONSTRAINT FK_95B4773850B241AB FOREIGN KEY (id_salesperson) REFERENCES salesperson (code)');
        $this->addSql('ALTER TABLE operation_sent ADD CONSTRAINT FK_95B47738BF46BF7C FOREIGN KEY (id_operation_) REFERENCES operations (name)');
        $this->addSql('ALTER TABLE operation_sent ADD CONSTRAINT FK_95B47738639BF9E6 FOREIGN KEY (id_contacts) REFERENCES contacts (code)');
        $this->addSql('ALTER TABLE salesperson ADD CONSTRAINT FK_48A08C5CD3D45F3A FOREIGN KEY (id_leader) REFERENCES salesperson (code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F6A78379F');
        $this->addSql('ALTER TABLE last_turnovers DROP FOREIGN KEY FK_3E1F44489122A03F');
        $this->addSql('ALTER TABLE work_contacts_companys DROP FOREIGN KEY FK_8E516FAD9122A03F');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FFD51597D');
        $this->addSql('ALTER TABLE work_contacts_companys DROP FOREIGN KEY FK_8E516FAD92FF4F48');
        $this->addSql('ALTER TABLE operation_sent DROP FOREIGN KEY FK_95B47738639BF9E6');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FB4F7CA15');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F748A6BA9');
        $this->addSql('ALTER TABLE operation_sent DROP FOREIGN KEY FK_95B47738BF46BF7C');
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_334015731F198DBE');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F50B241AB');
        $this->addSql('ALTER TABLE operation_sent DROP FOREIGN KEY FK_95B4773850B241AB');
        $this->addSql('ALTER TABLE salesperson DROP FOREIGN KEY FK_48A08C5CD3D45F3A');
        $this->addSql('ALTER TABLE last_turnovers DROP FOREIGN KEY FK_3E1F4448A9E52769');
        $this->addSql('DROP TABLE activity_area');
        $this->addSql('DROP TABLE behavior');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE last_turnovers');
        $this->addSql('DROP TABLE company_category');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE work_contacts_companys');
        $this->addSql('DROP TABLE graphic_style');
        $this->addSql('DROP TABLE legal_status');
        $this->addSql('DROP TABLE number_employees');
        $this->addSql('DROP TABLE object_table');
        $this->addSql('DROP TABLE operations');
        $this->addSql('DROP TABLE operation_sent');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE salesperson');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE site_type');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE turnovers');
    }
}
