<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200920134037 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_category DROP FOREIGN KEY FK_72113DE6F675F31B');
        $this->addSql('DROP INDEX IDX_72113DE6F675F31B ON blog_category');
        $this->addSql('ALTER TABLE blog_category CHANGE author_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_72113DE6A76ED395 ON blog_category (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_category DROP FOREIGN KEY FK_72113DE6A76ED395');
        $this->addSql('DROP INDEX IDX_72113DE6A76ED395 ON blog_category');
        $this->addSql('ALTER TABLE blog_category CHANGE user_id author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_72113DE6F675F31B ON blog_category (author_id)');
    }
}
