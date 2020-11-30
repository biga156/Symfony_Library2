<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124135414 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdrom ADD searchable TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE livre ADD searchable TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE micro_film ADD searchable TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE news_paper ADD searchable TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE ressource ADD searchable TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cdrom DROP searchable');
        $this->addSql('ALTER TABLE livre DROP searchable');
        $this->addSql('ALTER TABLE micro_film DROP searchable');
        $this->addSql('ALTER TABLE news_paper DROP searchable');
        $this->addSql('ALTER TABLE ressource DROP searchable');
    }
}
