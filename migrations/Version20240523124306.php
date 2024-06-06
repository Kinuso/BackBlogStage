<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523124306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post ADD blog_user_id INT NOT NULL, CHANGE title title VARCHAR(50) NOT NULL, CHANGE date date VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D4B986E16 FOREIGN KEY (blog_user_id) REFERENCES blog_user (id)');
        $this->addSql('CREATE INDEX IDX_BA5AE01D4B986E16 ON blog_post (blog_user_id)');
        $this->addSql('ALTER TABLE blog_user DROP FOREIGN KEY FK_6D435AD9A77FBEAF');
        $this->addSql('DROP INDEX IDX_6D435AD9A77FBEAF ON blog_user');
        $this->addSql('ALTER TABLE blog_user DROP blog_post_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01D4B986E16');
        $this->addSql('DROP INDEX IDX_BA5AE01D4B986E16 ON blog_post');
        $this->addSql('ALTER TABLE blog_post DROP blog_user_id, CHANGE title title VARCHAR(255) NOT NULL, CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE blog_user ADD blog_post_id INT NOT NULL');
        $this->addSql('ALTER TABLE blog_user ADD CONSTRAINT FK_6D435AD9A77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6D435AD9A77FBEAF ON blog_user (blog_post_id)');
    }
}
