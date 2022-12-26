<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221212151813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package (id INT AUTO_INCREMENT NOT NULL, items_id INT DEFAULT NULL, qr_code_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, quantity INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DE6867956BB0AE84 (items_id), UNIQUE INDEX UNIQ_DE68679512E4AD80 (qr_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package_action (id INT AUTO_INCREMENT NOT NULL, package_id INT NOT NULL, action_type_id INT NOT NULL, quantity INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', comment VARCHAR(255) DEFAULT NULL, INDEX IDX_7937FF4EF44CABFF (package_id), INDEX IDX_7937FF4E1FEE0472 (action_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, qr_code_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_741D53CD12E4AD80 (qr_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_package (place_id INT NOT NULL, package_id INT NOT NULL, INDEX IDX_EAA4706EDA6A219 (place_id), INDEX IDX_EAA4706EF44CABFF (package_id), PRIMARY KEY(place_id, package_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_action (id INT AUTO_INCREMENT NOT NULL, place_id INT NOT NULL, package_id INT DEFAULT NULL, action_type_id INT NOT NULL, comment VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E5028BFBDA6A219 (place_id), INDEX IDX_E5028BFBF44CABFF (package_id), INDEX IDX_E5028BFB1FEE0472 (action_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qr_code (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7D8B1FB52B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE package ADD CONSTRAINT FK_DE6867956BB0AE84 FOREIGN KEY (items_id) REFERENCES Items (id)');
        $this->addSql('ALTER TABLE package ADD CONSTRAINT FK_DE68679512E4AD80 FOREIGN KEY (qr_code_id) REFERENCES qr_code (id)');
        $this->addSql('ALTER TABLE package_action ADD CONSTRAINT FK_7937FF4EF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE package_action ADD CONSTRAINT FK_7937FF4E1FEE0472 FOREIGN KEY (action_type_id) REFERENCES action_type (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD12E4AD80 FOREIGN KEY (qr_code_id) REFERENCES qr_code (id)');
        $this->addSql('ALTER TABLE place_package ADD CONSTRAINT FK_EAA4706EDA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_package ADD CONSTRAINT FK_EAA4706EF44CABFF FOREIGN KEY (package_id) REFERENCES package (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_action ADD CONSTRAINT FK_E5028BFBDA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE place_action ADD CONSTRAINT FK_E5028BFBF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE place_action ADD CONSTRAINT FK_E5028BFB1FEE0472 FOREIGN KEY (action_type_id) REFERENCES action_type (id)');
        $this->addSql('ALTER TABLE Users ADD password VARCHAR(255) DEFAULT NULL');

//        $this->addSql('UPDATE TABLE Users SET password = UserPassword');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE package DROP FOREIGN KEY FK_DE6867956BB0AE84');
        $this->addSql('ALTER TABLE package DROP FOREIGN KEY FK_DE68679512E4AD80');
        $this->addSql('ALTER TABLE package_action DROP FOREIGN KEY FK_7937FF4EF44CABFF');
        $this->addSql('ALTER TABLE package_action DROP FOREIGN KEY FK_7937FF4E1FEE0472');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD12E4AD80');
        $this->addSql('ALTER TABLE place_package DROP FOREIGN KEY FK_EAA4706EDA6A219');
        $this->addSql('ALTER TABLE place_package DROP FOREIGN KEY FK_EAA4706EF44CABFF');
        $this->addSql('ALTER TABLE place_action DROP FOREIGN KEY FK_E5028BFBDA6A219');
        $this->addSql('ALTER TABLE place_action DROP FOREIGN KEY FK_E5028BFBF44CABFF');
        $this->addSql('ALTER TABLE place_action DROP FOREIGN KEY FK_E5028BFB1FEE0472');
        $this->addSql('DROP TABLE action_type');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE package_action');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE place_package');
        $this->addSql('DROP TABLE place_action');
        $this->addSql('DROP TABLE qr_code');
        $this->addSql('ALTER TABLE Users DROP password');
    }
}
