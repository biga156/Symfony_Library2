<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123150738 extends AbstractMigration
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
        $this->addSql('CREATE TABLE loan (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, udated_at DATETIME DEFAULT NULL, searchable TINYINT(1) NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_C5D30D03A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loan_ressource (loan_id INT NOT NULL, ressource_id INT NOT NULL, INDEX IDX_D2CC79DECE73868F (loan_id), INDEX IDX_D2CC79DEFC6CD52A (ressource_id), PRIMARY KEY(loan_id, ressource_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE micro_film (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cote VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_paper (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cote VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cote VARCHAR(255) NOT NULL, availability TINYINT(1) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, fees TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D03A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE loan_ressource ADD CONSTRAINT FK_D2CC79DECE73868F FOREIGN KEY (loan_id) REFERENCES loan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loan_ressource ADD CONSTRAINT FK_D2CC79DEFC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loan_ressource DROP FOREIGN KEY FK_D2CC79DECE73868F');
        $this->addSql('ALTER TABLE loan_ressource DROP FOREIGN KEY FK_D2CC79DEFC6CD52A');
        $this->addSql('ALTER TABLE loan DROP FOREIGN KEY FK_C5D30D03A76ED395');
        $this->addSql('DROP TABLE cdrom');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE loan');
        $this->addSql('DROP TABLE loan_ressource');
        $this->addSql('DROP TABLE micro_film');
        $this->addSql('DROP TABLE news_paper');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE user');
    }
}
