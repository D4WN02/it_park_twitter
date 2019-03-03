<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190210103313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, text, created_at, updated_at, title FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, text CLOB NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, title VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, text, created_at, updated_at, title) SELECT id, text, created_at, updated_at, title FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_5A8A6C8DF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, text, created_at, updated_at, title FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text CLOB NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, title VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO post (id, text, created_at, updated_at, title) SELECT id, text, created_at, updated_at, title FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
    }
}
