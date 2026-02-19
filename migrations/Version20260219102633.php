<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219102633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE background (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE `character` ADD owner_id INT DEFAULT NULL, ADD race_id INT DEFAULT NULL, ADD classe_id INT DEFAULT NULL, ADD background_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0347E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0346E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0348F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034C93D69EA FOREIGN KEY (background_id) REFERENCES background (id)');
        $this->addSql('CREATE INDEX IDX_937AB0347E3C61F9 ON `character` (owner_id)');
        $this->addSql('CREATE INDEX IDX_937AB0346E59D40D ON `character` (race_id)');
        $this->addSql('CREATE INDEX IDX_937AB0348F5EA509 ON `character` (classe_id)');
        $this->addSql('CREATE INDEX IDX_937AB034C93D69EA ON `character` (background_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE background');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE race');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0347E3C61F9');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0346E59D40D');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0348F5EA509');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034C93D69EA');
        $this->addSql('DROP INDEX IDX_937AB0347E3C61F9 ON `character`');
        $this->addSql('DROP INDEX IDX_937AB0346E59D40D ON `character`');
        $this->addSql('DROP INDEX IDX_937AB0348F5EA509 ON `character`');
        $this->addSql('DROP INDEX IDX_937AB034C93D69EA ON `character`');
        $this->addSql('ALTER TABLE `character` DROP owner_id, DROP race_id, DROP classe_id, DROP background_id');
    }
}
