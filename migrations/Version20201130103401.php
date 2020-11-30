<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130103401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loan_ressource DROP FOREIGN KEY FK_D2CC79DEFC6CD52A');
        $this->addSql('DROP TABLE loan_cdrom');
        $this->addSql('DROP TABLE loan_livre');
        $this->addSql('DROP TABLE loan_ressource');
        $this->addSql('DROP TABLE ressource');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE loan_cdrom (loan_id INT NOT NULL, cdrom_id INT NOT NULL, INDEX IDX_7D5E5438CE73868F (loan_id), INDEX IDX_7D5E5438497B6F6D (cdrom_id), PRIMARY KEY(loan_id, cdrom_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE loan_livre (loan_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_FBDA57C6CE73868F (loan_id), INDEX IDX_FBDA57C637D925CB (livre_id), PRIMARY KEY(loan_id, livre_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE loan_ressource (loan_id INT NOT NULL, ressource_id INT NOT NULL, INDEX IDX_D2CC79DECE73868F (loan_id), INDEX IDX_D2CC79DEFC6CD52A (ressource_id), PRIMARY KEY(loan_id, ressource_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cote VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, availability TINYINT(1) NOT NULL, picture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, searchable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE loan_cdrom ADD CONSTRAINT FK_7D5E5438497B6F6D FOREIGN KEY (cdrom_id) REFERENCES cdrom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loan_cdrom ADD CONSTRAINT FK_7D5E5438CE73868F FOREIGN KEY (loan_id) REFERENCES loan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loan_livre ADD CONSTRAINT FK_FBDA57C637D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loan_livre ADD CONSTRAINT FK_FBDA57C6CE73868F FOREIGN KEY (loan_id) REFERENCES loan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loan_ressource ADD CONSTRAINT FK_D2CC79DECE73868F FOREIGN KEY (loan_id) REFERENCES loan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loan_ressource ADD CONSTRAINT FK_D2CC79DEFC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
    }
}
