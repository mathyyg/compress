<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013141721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F361054FFE465');
        $this->addSql('DROP INDEX UNIQ_8C9F361054FFE465 ON file');
        $this->addSql('ALTER TABLE file CHANGE resource_id resource_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F361054FFE465 FOREIGN KEY (resource_id_id) REFERENCES resource (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C9F361054FFE465 ON file (resource_id_id)');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F154FFE465');
        $this->addSql('DROP INDEX UNIQ_36AC99F154FFE465 ON link');
        $this->addSql('ALTER TABLE link ADD link_id INT NOT NULL, CHANGE resource_id resource_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F154FFE465 FOREIGN KEY (resource_id_id) REFERENCES resource (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36AC99F154FFE465 ON link (resource_id_id)');
        $this->addSql('ALTER TABLE utilisation DROP FOREIGN KEY FK_B02A3C4354FFE465');
        $this->addSql('DROP INDEX IDX_B02A3C4354FFE465 ON utilisation');
        $this->addSql('ALTER TABLE utilisation CHANGE resource_id resource_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisation ADD CONSTRAINT FK_B02A3C4354FFE465 FOREIGN KEY (resource_id_id) REFERENCES resource (id)');
        $this->addSql('CREATE INDEX IDX_B02A3C4354FFE465 ON utilisation (resource_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F361054FFE465');
        $this->addSql('DROP INDEX UNIQ_8C9F361054FFE465 ON file');
        $this->addSql('ALTER TABLE file CHANGE resource_id_id resource_id INT NOT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F361054FFE465 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C9F361054FFE465 ON file (resource_id)');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F154FFE465');
        $this->addSql('DROP INDEX UNIQ_36AC99F154FFE465 ON link');
        $this->addSql('ALTER TABLE link ADD resource_id INT NOT NULL, DROP resource_id_id, DROP link_id');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F154FFE465 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36AC99F154FFE465 ON link (resource_id)');
        $this->addSql('ALTER TABLE utilisation DROP FOREIGN KEY FK_B02A3C4354FFE465');
        $this->addSql('DROP INDEX IDX_B02A3C4354FFE465 ON utilisation');
        $this->addSql('ALTER TABLE utilisation CHANGE resource_id_id resource_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisation ADD CONSTRAINT FK_B02A3C4354FFE465 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('CREATE INDEX IDX_B02A3C4354FFE465 ON utilisation (resource_id)');
    }
}
