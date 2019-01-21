<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190106141217 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, id_country_id INT DEFAULT NULL, id_activity_area_id INT DEFAULT NULL, id_legal_status_id INT DEFAULT NULL, id_turnover_id INT DEFAULT NULL, id_last_turnover_id INT DEFAULT NULL, user_id INT DEFAULT NULL, country_id INT NOT NULL, company_category_id INT NOT NULL, company_nb_employees_id INT DEFAULT NULL, parameter_comportment_id INT DEFAULT NULL, parameter_object_id INT DEFAULT NULL, parameter_target_id INT DEFAULT NULL, parameter_type_site_id INT DEFAULT NULL, company_code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at_plug DATETIME NOT NULL, update_at_plug DATETIME NOT NULL, leader_code VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, commentary LONGTEXT DEFAULT NULL, coutry VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, adress_complement VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(5) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone VARCHAR(10) DEFAULT NULL, fax VARCHAR(10) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, adress_commentary LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, siret_number VARCHAR(255) NOT NULL, naf_code VARCHAR(255) DEFAULT NULL, source VARCHAR(255) DEFAULT NULL, INDEX IDX_4FBF094F5CA5BEA7 (id_country_id), INDEX IDX_4FBF094F5ED763AD (id_activity_area_id), INDEX IDX_4FBF094F6E60FC64 (id_legal_status_id), INDEX IDX_4FBF094F9F5B14B4 (id_turnover_id), INDEX IDX_4FBF094F24F5F39E (id_last_turnover_id), INDEX IDX_4FBF094FA76ED395 (user_id), INDEX IDX_4FBF094FF92F3E70 (country_id), INDEX IDX_4FBF094FB97257A (company_category_id), INDEX IDX_4FBF094F8AD3A8A8 (company_nb_employees_id), INDEX IDX_4FBF094F432DFB2 (parameter_comportment_id), INDEX IDX_4FBF094FDA79FB99 (parameter_object_id), INDEX IDX_4FBF094FECDAA6D4 (parameter_target_id), INDEX IDX_4FBF094F6FE9047D (parameter_type_site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_activity_area (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
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
        $this->addSql('CREATE TABLE paramater_graphic_styles (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, operation_id INT DEFAULT NULL, company_activity_area_id INT NOT NULL, company_category_id INT DEFAULT NULL, company_nb_employees_id INT NOT NULL, company_turnover_id INT DEFAULT NULL, company_last_turnover_id INT DEFAULT NULL, parameter_comportment_id INT DEFAULT NULL, parameter_object_id INT DEFAULT NULL, parameter_target_id INT DEFAULT NULL, parameter_type_site_id INT DEFAULT NULL, name_application VARCHAR(255) NOT NULL, logo_client VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address_complement VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL, fax VARCHAR(255) NOT NULL, email_contact VARCHAR(255) NOT NULL, email_admin VARCHAR(255) NOT NULL, email_receipt_requests VARCHAR(255) NOT NULL, INDEX IDX_2A979110A76ED395 (user_id), UNIQUE INDEX UNIQ_2A97911044AC3583 (operation_id), INDEX IDX_2A97911093A6CAC7 (company_activity_area_id), INDEX IDX_2A979110B97257A (company_category_id), INDEX IDX_2A9791108AD3A8A8 (company_nb_employees_id), INDEX IDX_2A9791109E9861DB (company_turnover_id), INDEX IDX_2A979110E9845AF4 (company_last_turnover_id), INDEX IDX_2A979110432DFB2 (parameter_comportment_id), INDEX IDX_2A979110DA79FB99 (parameter_object_id), INDEX IDX_2A979110ECDAA6D4 (parameter_target_id), INDEX IDX_2A9791106FE9047D (parameter_type_site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_contact_job (parameter_id INT NOT NULL, contact_job_id INT NOT NULL, INDEX IDX_78766BFB7C56DBD6 (parameter_id), INDEX IDX_78766BFB9B727928 (contact_job_id), PRIMARY KEY(parameter_id, contact_job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_comportment (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_object (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_target (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter_type_site (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, leader_id INT DEFAULT NULL, code VARCHAR(20) NOT NULL, gender VARCHAR(1) NOT NULL, first_name VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, profil VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, statement TINYINT(1) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, job_name VARCHAR(255) DEFAULT NULL, tel_mobile VARCHAR(15) DEFAULT NULL, tel_fixe VARCHAR(15) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, url_linkedin VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_8D93D64973154ED4 (leader_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F5CA5BEA7 FOREIGN KEY (id_country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F5ED763AD FOREIGN KEY (id_activity_area_id) REFERENCES company_activity_area (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F6E60FC64 FOREIGN KEY (id_legal_status_id) REFERENCES company_legal_status (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F9F5B14B4 FOREIGN KEY (id_turnover_id) REFERENCES company_turnover (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F24F5F39E FOREIGN KEY (id_last_turnover_id) REFERENCES company_last_turnover (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB97257A FOREIGN KEY (company_category_id) REFERENCES company_category (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F8AD3A8A8 FOREIGN KEY (company_nb_employees_id) REFERENCES company_nb_employees (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F432DFB2 FOREIGN KEY (parameter_comportment_id) REFERENCES parameter_comportment (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FDA79FB99 FOREIGN KEY (parameter_object_id) REFERENCES parameter_object (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FECDAA6D4 FOREIGN KEY (parameter_target_id) REFERENCES parameter_target (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F6FE9047D FOREIGN KEY (parameter_type_site_id) REFERENCES parameter_type_site (id)');
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
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638979B1AD6');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F5ED763AD');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A97911093A6CAC7');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FB97257A');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A979110B97257A');
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
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF92F3E70');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638708A0E0');
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
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_activity_area');
        $this->addSql('DROP TABLE company_category');
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
        $this->addSql('DROP TABLE paramater_graphic_styles');
        $this->addSql('DROP TABLE parameter');
        $this->addSql('DROP TABLE parameter_contact_job');
        $this->addSql('DROP TABLE parameter_comportment');
        $this->addSql('DROP TABLE parameter_object');
        $this->addSql('DROP TABLE parameter_target');
        $this->addSql('DROP TABLE parameter_type_site');
        $this->addSql('DROP TABLE user');
    }
}
