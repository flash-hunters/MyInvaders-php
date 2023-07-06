<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703173611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flash (id INT AUTO_INCREMENT NOT NULL, flash_user_id INT NOT NULL, flash_date DATE DEFAULT NULL, INDEX IDX_AFCE5F0351A1DBD6 (flash_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_invader (id INT AUTO_INCREMENT NOT NULL, area_id INT NOT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, status VARCHAR(255) NOT NULL, position VARCHAR(255) DEFAULT NULL, comments LONGTEXT DEFAULT NULL, INDEX IDX_2DFF0A2DBD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flash ADD CONSTRAINT FK_AFCE5F0351A1DBD6 FOREIGN KEY (flash_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE space_invader ADD CONSTRAINT FK_2DFF0A2DBD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flash DROP FOREIGN KEY FK_AFCE5F0351A1DBD6');
        $this->addSql('ALTER TABLE space_invader DROP FOREIGN KEY FK_2DFF0A2DBD0F409C');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE flash');
        $this->addSql('DROP TABLE space_invader');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
