<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190216153137 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company DROP FOREIGN KEY company_activity_area_FK');
        $this->addSql('ALTER TABLE operation_sent DROP FOREIGN KEY operation_sent_ibfk_3');
        $this->addSql('ALTER TABLE work_contacts_companys DROP FOREIGN KEY work_contacts_companys_ibfk_2');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY company_legal_status2_FK');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY company_number_employees1_FK');
        $this->addSql('ALTER TABLE operation_sent DROP FOREIGN KEY operation_sent_ibfk_2');
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY contacts_ibfk_1');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY company_ibfk_1');
        $this->addSql('ALTER TABLE operation_sent DROP FOREIGN KEY operation_sent_ibfk_1');
        $this->addSql('ALTER TABLE salesperson DROP FOREIGN KEY salesperson_ibfk_1');
        $this->addSql('ALTER TABLE last_turnovers DROP FOREIGN KEY last_turnovers_ibfk_2');
        $this->addSql('CREATE TABLE company_activity_area (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_last_turnover (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_legal_status (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_nb_employees (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_turnover (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, id_job_id INT DEFAULT NULL, user_id INT DEFAULT NULL, company_id INT DEFAULT NULL, gender_id INT DEFAULT NULL, contact_company_service_id INT DEFAULT NULL, contact_company_function_id INT DEFAULT NULL, code_customer VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, date_created_plug DATETIME NOT NULL, date_update_plug DATETIME NOT NULL, status TINYINT(1) DEFAULT NULL, decision_level INT DEFAULT NULL, birth_date DATETIME DEFAULT NULL, job VARCHAR(255) DEFAULT NULL, mobile_phone VARCHAR(10) DEFAULT NULL, phone VARCHAR(10) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, email_prechecked TINYINT(1) DEFAULT NULL, email_checked TINYINT(1) DEFAULT NULL, url_linkedin VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, operation_source VARCHAR(255) DEFAULT NULL, commentary VARCHAR(255) DEFAULT NULL, opt_in_newsletter TINYINT(1) NOT NULL, opt_in_offer_commercial TINYINT(1) NOT NULL, INDEX IDX_4C62E6382DD7FB44 (id_job_id), INDEX IDX_4C62E638A76ED395 (user_id), INDEX IDX_4C62E638979B1AD6 (company_id), INDEX IDX_4C62E638708A0E0 (gender_id), INDEX IDX_4C62E638A52A278A (contact_company_service_id), INDEX IDX_4C62E6382348D3FC (contact_company_function_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_company_function (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_company_service (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_job (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, id_type_operation_id INT DEFAULT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, url VARCHAR(255) DEFAULT NULL, visual_header VARCHAR(255) DEFAULT NULL, visual_lateral VARCHAR(255) DEFAULT NULL, INDEX IDX_1981A66D32D8E791 (id_type_operation_id), INDEX IDX_1981A66DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_participation (id INT AUTO_INCREMENT NOT NULL, id_operation_id INT NOT NULL, INDEX IDX_A20A35ED676D40F1 (id_operation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_participation_contact (operation_participation_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_71D85290859FADC9 (operation_participation_id), INDEX IDX_71D85290E7A1254A (contact_id), PRIMARY KEY(operation_participation_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_type_operation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, operation_id INT DEFAULT NULL, company_activity_area_id INT NOT NULL, company_category_id INT DEFAULT NULL, company_nb_employees_id INT NOT NULL, company_turnover_id INT DEFAULT NULL, company_last_turnover_id INT DEFAULT NULL, parameter_comportment_id INT DEFAULT NULL, parameter_object_id INT DEFAULT NULL, parameter_target_id INT DEFAULT NULL, parameter_type_site_id INT DEFAULT NULL, name_application VARCHAR(255) NOT NULL, logo_client VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address_complement VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL, fax VARCHAR(255) NOT NULL, email_contact VARCHAR(255) NOT NULL, email_admin VARCHAR(255) NOT NULL, email_receipt_requests VARCHAR(255) NOT NULL, INDEX IDX_2A979110A76ED395 (user_id), UNIQUE INDEX UNIQ_2A97911044AC3583 (operation_id), INDEX IDX_2A97911093A6CAC7 (company_activity_area_id), INDEX IDX_2A979110B97257A (company_category_id), INDEX IDX_2A9791108AD3A8A8 (company_nb_employees_id), INDEX IDX_2A9791109E9861DB (company_turnover_id), INDEX IDX_2A979110E9845AF4 (company_last_turnover_id), INDEX IDX_2A979110432DFB2 (parameter_comportment_id), INDEX IDX_2A979110DA79FB99 (parameter_object_id), INDEX IDX_2A979110ECDAA6D4 (parameter_target_id), INDEX IDX_2A9791106FE9047D (parameter_type_site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_contact_job (parameter_id INT NOT NULL, contact_job_id INT NOT NULL, INDEX IDX_78766BFB7C56DBD6 (parameter_id), INDEX IDX_78766BFB9B727928 (contact_job_id), PRIMARY KEY(parameter_id, contact_job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_comportment (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_graphic_styles (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_object (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_target (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_type_site (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, leader_id INT DEFAULT NULL, gender_id INT DEFAULT NULL, code VARCHAR(20) NOT NULL, first_name VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, profil VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, statement TINYINT(1) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, job_name VARCHAR(255) DEFAULT NULL, tel_mobile VARCHAR(15) DEFAULT NULL, tel_fixe VARCHAR(15) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, url_linkedin VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D64973154ED4 (leader_id), INDEX IDX_8D93D649708A0E0 (gender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6382DD7FB44 FOREIGN KEY (id_job_id) REFERENCES contact_job (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A52A278A FOREIGN KEY (contact_company_service_id) REFERENCES contact_company_service (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6382348D3FC FOREIGN KEY (contact_company_function_id) REFERENCES contact_company_function (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D32D8E791 FOREIGN KEY (id_type_operation_id) REFERENCES operation_type_operation (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE operation_participation ADD CONSTRAINT FK_A20A35ED676D40F1 FOREIGN KEY (id_operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE operation_participation_contact ADD CONSTRAINT FK_71D85290859FADC9 FOREIGN KEY (operation_participation_id) REFERENCES operation_participation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE operation_participation_contact ADD CONSTRAINT FK_71D85290E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A979110A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A97911044AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A97911093A6CAC7 FOREIGN KEY (company_activity_area_id) REFERENCES company_activity_area (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A979110B97257A FOREIGN KEY (company_category_id) REFERENCES company_category (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A9791108AD3A8A8 FOREIGN KEY (company_nb_employees_id) REFERENCES company_nb_employees (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A9791109E9861DB FOREIGN KEY (company_turnover_id) REFERENCES company_turnover (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A979110E9845AF4 FOREIGN KEY (company_last_turnover_id) REFERENCES company_last_turnover (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A979110432DFB2 FOREIGN KEY (parameter_comportment_id) REFERENCES parameter_comportment (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A979110DA79FB99 FOREIGN KEY (parameter_object_id) REFERENCES parameter_object (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A979110ECDAA6D4 FOREIGN KEY (parameter_target_id) REFERENCES parameter_target (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A9791106FE9047D FOREIGN KEY (parameter_type_site_id) REFERENCES parameter_type_site (id)');
        $this->addSql('ALTER TABLE parameter_contact_job ADD CONSTRAINT FK_78766BFB7C56DBD6 FOREIGN KEY (parameter_id) REFERENCES parameter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parameter_contact_job ADD CONSTRAINT FK_78766BFB9B727928 FOREIGN KEY (contact_job_id) REFERENCES contact_job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64973154ED4 FOREIGN KEY (leader_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('DROP TABLE activity_area');
        $this->addSql('DROP TABLE behavior');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE graphic_style');
        $this->addSql('DROP TABLE last_turnovers');
        $this->addSql('DROP TABLE legal_status');
        $this->addSql('DROP TABLE number_employees');
        $this->addSql('DROP TABLE object');
        $this->addSql('DROP TABLE operation_sent');
        $this->addSql('DROP TABLE operations');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE salesperson');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE site_type');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE turnovers');
        $this->addSql('DROP TABLE work_contacts_companys');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY company_company_category0_FK');
        $this->addSql('DROP INDEX company_company_category0_FK ON company');
        $this->addSql('DROP INDEX company_legal_status2_FK ON company');
        $this->addSql('DROP INDEX company_activity_area_FK ON company');
        $this->addSql('DROP INDEX company_number_employees1_FK ON company');
        $this->addSql('DROP INDEX id_salesperson ON company');
        $this->addSql('ALTER TABLE company DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE company ADD id INT AUTO_INCREMENT NOT NULL, ADD id_country_id INT DEFAULT NULL, ADD id_activity_area_id INT DEFAULT NULL, ADD id_legal_status_id INT DEFAULT NULL, ADD id_turnover_id INT DEFAULT NULL, ADD id_last_turnover_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, ADD company_category_id INT NOT NULL, ADD company_nb_employees_id INT DEFAULT NULL, ADD parameter_comportment_id INT DEFAULT NULL, ADD parameter_object_id INT DEFAULT NULL, ADD parameter_target_id INT DEFAULT NULL, ADD parameter_type_site_id INT DEFAULT NULL, ADD company_code VARCHAR(255) NOT NULL, ADD leader_code VARCHAR(255) DEFAULT NULL, ADD adress VARCHAR(255) DEFAULT NULL, ADD adress_complement VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD adress_commentary LONGTEXT DEFAULT NULL, ADD siret_number VARCHAR(255) NOT NULL, DROP code, DROP id_activity_area, DROP id_company_category, DROP id_number_employees, DROP id_legal_status, DROP id_salesperson, DROP updated_at, DROP country, DROP address, DROP additional_address, DROP town, DROP created_at_company, DROP siret, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE naf_code naf_code VARCHAR(255) DEFAULT NULL, CHANGE source source VARCHAR(255) DEFAULT NULL, CHANGE comment commentary LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F5CA5BEA7 FOREIGN KEY (id_country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F5ED763AD FOREIGN KEY (id_activity_area_id) REFERENCES company_activity_area (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F6E60FC64 FOREIGN KEY (id_legal_status_id) REFERENCES company_legal_status (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F9F5B14B4 FOREIGN KEY (id_turnover_id) REFERENCES company_turnover (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F24F5F39E FOREIGN KEY (id_last_turnover_id) REFERENCES company_last_turnover (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB97257A FOREIGN KEY (company_category_id) REFERENCES company_category (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F8AD3A8A8 FOREIGN KEY (company_nb_employees_id) REFERENCES company_nb_employees (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F432DFB2 FOREIGN KEY (parameter_comportment_id) REFERENCES parameter_comportment (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FDA79FB99 FOREIGN KEY (parameter_object_id) REFERENCES parameter_object (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FECDAA6D4 FOREIGN KEY (parameter_target_id) REFERENCES parameter_target (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F6FE9047D FOREIGN KEY (parameter_type_site_id) REFERENCES parameter_type_site (id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F5CA5BEA7 ON company (id_country_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F5ED763AD ON company (id_activity_area_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F6E60FC64 ON company (id_legal_status_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F9F5B14B4 ON company (id_turnover_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F24F5F39E ON company (id_last_turnover_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094FA76ED395 ON company (user_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094FB97257A ON company (company_category_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F8AD3A8A8 ON company (company_nb_employees_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F432DFB2 ON company (parameter_comportment_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094FDA79FB99 ON company (parameter_object_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094FECDAA6D4 ON company (parameter_target_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F6FE9047D ON company (parameter_type_site_id)');
        $this->addSql('ALTER TABLE company ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE company_category CHANGE libelle label VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F5ED763AD');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A97911093A6CAC7');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F24F5F39E');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A979110E9845AF4');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F6E60FC64');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F8AD3A8A8');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A9791108AD3A8A8');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F9F5B14B4');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A9791109E9861DB');
        $this->addSql('ALTER TABLE operation_participation_contact DROP FOREIGN KEY FK_71D85290E7A1254A');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6382348D3FC');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A52A278A');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6382DD7FB44');
        $this->addSql('ALTER TABLE parameter_contact_job DROP FOREIGN KEY FK_78766BFB9B727928');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F5CA5BEA7');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638708A0E0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649708A0E0');
        $this->addSql('ALTER TABLE operation_participation DROP FOREIGN KEY FK_A20A35ED676D40F1');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A97911044AC3583');
        $this->addSql('ALTER TABLE operation_participation_contact DROP FOREIGN KEY FK_71D85290859FADC9');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D32D8E791');
        $this->addSql('ALTER TABLE parameter_contact_job DROP FOREIGN KEY FK_78766BFB7C56DBD6');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F432DFB2');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A979110432DFB2');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FDA79FB99');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A979110DA79FB99');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FECDAA6D4');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A979110ECDAA6D4');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F6FE9047D');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A9791106FE9047D');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A76ED395');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66DA76ED395');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A979110A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64973154ED4');
        $this->addSql('CREATE TABLE activity_area (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE behavior (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contacts (code VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, id_profession INT NOT NULL, gender VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, last_name VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, first_name VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status TINYINT(1) DEFAULT NULL, decision_level CHAR(1) DEFAULT NULL COLLATE latin1_swedish_ci, birth_date DATETIME DEFAULT NULL, mobile_phone VARCHAR(10) DEFAULT NULL COLLATE latin1_swedish_ci, phone VARCHAR(10) DEFAULT NULL COLLATE latin1_swedish_ci, email VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, email_prechecked TINYINT(1) DEFAULT NULL, email_checked TINYINT(1) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, picture VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, operation_source VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, comment LONGTEXT DEFAULT NULL COLLATE latin1_swedish_ci, opt_in_newsletter TINYINT(1) DEFAULT NULL, opt_in_offres_commercial TINYINT(1) DEFAULT NULL, INDEX id_profession (id_profession), PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE graphic_style (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE last_turnovers (id_company VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, id_turnovers INT NOT NULL, created_at DATETIME NOT NULL, INDEX id_turnovers (id_turnovers), INDEX IDX_3E1F44489122A03F (id_company), PRIMARY KEY(id_company, id_turnovers)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE legal_status (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE number_employees (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE object (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE operation_sent (id_salesperson VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, id_contacts VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, id_operation_ VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, sent_at DATETIME NOT NULL, INDEX id_contacts (id_contacts), INDEX id_operation_ (id_operation_), INDEX IDX_95B4773850B241AB (id_salesperson), PRIMARY KEY(id_salesperson, id_contacts, id_operation_)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE operations (name VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, url VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, type_operation VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, visual_headband VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, visuel_lateral VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE salesperson (code VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, id_leader VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, gender VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, first_name VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, last_name VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, profile VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status TINYINT(1) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, work_name VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, mobile_phone VARCHAR(10) DEFAULT NULL COLLATE latin1_swedish_ci, phone VARCHAR(10) DEFAULT NULL COLLATE latin1_swedish_ci, email VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, linkedin VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, picture VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, INDEX id_leader (id_leader), PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE settings (id INT NOT NULL, application_name VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, application_logo VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, address VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, additional_address VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, phone VARCHAR(10) DEFAULT NULL COLLATE latin1_swedish_ci, fax VARCHAR(10) DEFAULT NULL COLLATE latin1_swedish_ci, email VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, email_admin VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, email_contact VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE site_type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE target (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE turnovers (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE work_contacts_companys (id_contact VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, id_company VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, function VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, service VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, INDEX id_company (id_company), INDEX IDX_8E516FAD92FF4F48 (id_contact), PRIMARY KEY(id_contact, id_company)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT contacts_ibfk_1 FOREIGN KEY (id_profession) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE last_turnovers ADD CONSTRAINT last_turnovers_ibfk_1 FOREIGN KEY (id_company) REFERENCES company (code)');
        $this->addSql('ALTER TABLE last_turnovers ADD CONSTRAINT last_turnovers_ibfk_2 FOREIGN KEY (id_turnovers) REFERENCES turnovers (id)');
        $this->addSql('ALTER TABLE operation_sent ADD CONSTRAINT operation_sent_ibfk_1 FOREIGN KEY (id_salesperson) REFERENCES salesperson (code)');
        $this->addSql('ALTER TABLE operation_sent ADD CONSTRAINT operation_sent_ibfk_2 FOREIGN KEY (id_operation_) REFERENCES operations (name)');
        $this->addSql('ALTER TABLE operation_sent ADD CONSTRAINT operation_sent_ibfk_3 FOREIGN KEY (id_contacts) REFERENCES contacts (code)');
        $this->addSql('ALTER TABLE salesperson ADD CONSTRAINT salesperson_ibfk_1 FOREIGN KEY (id_leader) REFERENCES salesperson (code)');
        $this->addSql('ALTER TABLE work_contacts_companys ADD CONSTRAINT work_contacts_companys_ibfk_1 FOREIGN KEY (id_company) REFERENCES company (code)');
        $this->addSql('ALTER TABLE work_contacts_companys ADD CONSTRAINT work_contacts_companys_ibfk_2 FOREIGN KEY (id_contact) REFERENCES contacts (code)');
        $this->addSql('DROP TABLE company_activity_area');
        $this->addSql('DROP TABLE company_last_turnover');
        $this->addSql('DROP TABLE company_legal_status');
        $this->addSql('DROP TABLE company_nb_employees');
        $this->addSql('DROP TABLE company_turnover');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_company_function');
        $this->addSql('DROP TABLE contact_company_service');
        $this->addSql('DROP TABLE contact_job');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE operation_participation');
        $this->addSql('DROP TABLE operation_participation_contact');
        $this->addSql('DROP TABLE operation_type_operation');
        $this->addSql('DROP TABLE parameter');
        $this->addSql('DROP TABLE parameter_contact_job');
        $this->addSql('DROP TABLE parameter_comportment');
        $this->addSql('DROP TABLE parameter_graphic_styles');
        $this->addSql('DROP TABLE parameter_object');
        $this->addSql('DROP TABLE parameter_target');
        $this->addSql('DROP TABLE parameter_type_site');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE company MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FB97257A');
        $this->addSql('DROP INDEX IDX_4FBF094F5CA5BEA7 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094F5ED763AD ON company');
        $this->addSql('DROP INDEX IDX_4FBF094F6E60FC64 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094F9F5B14B4 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094F24F5F39E ON company');
        $this->addSql('DROP INDEX IDX_4FBF094FA76ED395 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094FB97257A ON company');
        $this->addSql('DROP INDEX IDX_4FBF094F8AD3A8A8 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094F432DFB2 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094FDA79FB99 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094FECDAA6D4 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094F6FE9047D ON company');
        $this->addSql('ALTER TABLE company DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE company ADD code VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, ADD id_company_category INT NOT NULL, ADD id_number_employees INT NOT NULL, ADD id_legal_status INT NOT NULL, ADD id_salesperson VARCHAR(10) NOT NULL COLLATE latin1_swedish_ci, ADD updated_at DATETIME NOT NULL, ADD comment LONGTEXT DEFAULT NULL COLLATE latin1_swedish_ci, ADD country VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, ADD address VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, ADD additional_address VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, ADD town VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, ADD created_at_company DATETIME DEFAULT NULL, ADD siret VARCHAR(14) DEFAULT NULL COLLATE latin1_swedish_ci, DROP id, DROP id_country_id, DROP id_activity_area_id, DROP id_legal_status_id, DROP id_turnover_id, DROP id_last_turnover_id, DROP user_id, DROP company_nb_employees_id, DROP parameter_comportment_id, DROP parameter_object_id, DROP parameter_target_id, DROP parameter_type_site_id, DROP company_code, DROP leader_code, DROP commentary, DROP adress, DROP adress_complement, DROP city, DROP adress_commentary, DROP siret_number, CHANGE created_at created_at DATETIME NOT NULL, CHANGE naf_code naf_code VARCHAR(5) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE source source VARCHAR(5) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE company_category_id id_activity_area INT NOT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT company_activity_area_FK FOREIGN KEY (id_activity_area) REFERENCES activity_area (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT company_company_category0_FK FOREIGN KEY (id_company_category) REFERENCES company_category (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT company_ibfk_1 FOREIGN KEY (id_salesperson) REFERENCES salesperson (code)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT company_legal_status2_FK FOREIGN KEY (id_legal_status) REFERENCES legal_status (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT company_number_employees1_FK FOREIGN KEY (id_number_employees) REFERENCES number_employees (id)');
        $this->addSql('CREATE INDEX company_company_category0_FK ON company (id_company_category)');
        $this->addSql('CREATE INDEX company_legal_status2_FK ON company (id_legal_status)');
        $this->addSql('CREATE INDEX company_activity_area_FK ON company (id_activity_area)');
        $this->addSql('CREATE INDEX company_number_employees1_FK ON company (id_number_employees)');
        $this->addSql('CREATE INDEX id_salesperson ON company (id_salesperson)');
        $this->addSql('ALTER TABLE company ADD PRIMARY KEY (code)');
        $this->addSql('ALTER TABLE company_category CHANGE label libelle VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci');
    }
}
