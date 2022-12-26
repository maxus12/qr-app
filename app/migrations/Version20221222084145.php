<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222084145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE package_action ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE package_action ADD CONSTRAINT FK_7937FF4EA76ED395 FOREIGN KEY (user_id) REFERENCES Users (id)');
        $this->addSql('CREATE INDEX IDX_7937FF4EA76ED395 ON package_action (user_id)');
        $this->addSql('ALTER TABLE place_action ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE place_action ADD CONSTRAINT FK_E5028BFBA76ED395 FOREIGN KEY (user_id) REFERENCES Users (id)');
        $this->addSql('CREATE INDEX IDX_E5028BFBA76ED395 ON place_action (user_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Items CHANGE Remainder Remainder INT DEFAULT 0');
        $this->addSql('ALTER TABLE package_action DROP FOREIGN KEY FK_7937FF4EA76ED395');
        $this->addSql('DROP INDEX IDX_7937FF4EA76ED395 ON package_action');
        $this->addSql('ALTER TABLE package_action DROP user_id');
        $this->addSql('ALTER TABLE place_action DROP FOREIGN KEY FK_E5028BFBA76ED395');
        $this->addSql('DROP INDEX IDX_E5028BFBA76ED395 ON place_action');
        $this->addSql('ALTER TABLE place_action DROP user_id');
    }
}
