<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200920234330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD facebook_id VARCHAR(180) DEFAULT NULL, ADD youtube_id VARCHAR(180) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6499BE8FD98 ON user (facebook_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649BB7E40D1 ON user (youtube_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D6499BE8FD98 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649BB7E40D1 ON user');
        $this->addSql('ALTER TABLE user DROP facebook_id, DROP youtube_id');
    }
}
