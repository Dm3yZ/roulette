<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200607201722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE round (id BIGSERIAL NOT NULL, cells_count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE drop_result (id BIGSERIAL NOT NULL, round_id INT DEFAULT NULL, user_id INT NOT NULL, cell_number INT, drop_date TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_218927F8A6005CA0 ON drop_result (round_id)');
        $this->addSql('ALTER TABLE drop_result ADD CONSTRAINT FK_218927F8A6005CA0 FOREIGN KEY (round_id) REFERENCES round (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE drop_result DROP CONSTRAINT FK_218927F8A6005CA0');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE drop_result');
    }
}
