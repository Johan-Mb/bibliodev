<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220202101723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, subtheme_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, type VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_6A2CD5C75292C90E (subtheme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subthemes (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_733EBAFB59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE themes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ressources ADD CONSTRAINT FK_6A2CD5C75292C90E FOREIGN KEY (subtheme_id) REFERENCES subthemes (id)');
        $this->addSql('ALTER TABLE subthemes ADD CONSTRAINT FK_733EBAFB59027487 FOREIGN KEY (theme_id) REFERENCES themes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressources DROP FOREIGN KEY FK_6A2CD5C75292C90E');
        $this->addSql('ALTER TABLE subthemes DROP FOREIGN KEY FK_733EBAFB59027487');
        $this->addSql('DROP TABLE ressources');
        $this->addSql('DROP TABLE subthemes');
        $this->addSql('DROP TABLE themes');
        $this->addSql('DROP TABLE user');
    }
}
