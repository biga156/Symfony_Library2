<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123140454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cdrom (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cote VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, authtor VARCHAR(255) NOT NULL, bail DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cote VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, authtor VARCHAR(255) NOT NULL, special TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loan (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, udated_at DATETIME DEFAULT NULL, searchable TINYINT(1) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE micro_film (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cote VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_paper (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cote VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cote VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, fees TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cdrom');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE loan');
        $this->addSql('DROP TABLE micro_film');
        $this->addSql('DROP TABLE news_paper');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE user');
    }
}
