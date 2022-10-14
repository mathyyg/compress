<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013134952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, resource_id INT NOT NULL, name VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8C9F361054FFE465 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, resource_id INT NOT NULL, input_link VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_36AC99F154FFE465 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, date_created DATETIME NOT NULL, date_modified VARCHAR(255) DEFAULT NULL, resource_password VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_BC91F416A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisation (id INT AUTO_INCREMENT NOT NULL, resource_id INT NOT NULL, ip VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_B02A3C4354FFE465 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F361054FFE465 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F154FFE465 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F416A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE utilisation ADD CONSTRAINT FK_B02A3C4354FFE465 FOREIGN KEY (resource_id) REFERENCES resource (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F361054FFE465');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F154FFE465');
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F416A76ED395');
        $this->addSql('ALTER TABLE utilisation DROP FOREIGN KEY FK_B02A3C4354FFE465');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE utilisation');
    }
}
