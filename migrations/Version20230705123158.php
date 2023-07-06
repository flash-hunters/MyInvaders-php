<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230705123158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flash DROP FOREIGN KEY FK_AFCE5F03A77EC9A9');
        $this->addSql('DROP INDEX IDX_AFCE5F03A77EC9A9 ON flash');
        $this->addSql('ALTER TABLE flash CHANGE si_id space_invader_id INT NOT NULL');
        $this->addSql('ALTER TABLE flash ADD CONSTRAINT FK_AFCE5F03813917A9 FOREIGN KEY (space_invader_id) REFERENCES space_invader (id)');
        $this->addSql('CREATE INDEX IDX_AFCE5F03813917A9 ON flash (space_invader_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flash DROP FOREIGN KEY FK_AFCE5F03813917A9');
        $this->addSql('DROP INDEX IDX_AFCE5F03813917A9 ON flash');
        $this->addSql('ALTER TABLE flash CHANGE space_invader_id si_id INT NOT NULL');
        $this->addSql('ALTER TABLE flash ADD CONSTRAINT FK_AFCE5F03A77EC9A9 FOREIGN KEY (si_id) REFERENCES space_invader (id)');
        $this->addSql('CREATE INDEX IDX_AFCE5F03A77EC9A9 ON flash (si_id)');
    }
}
