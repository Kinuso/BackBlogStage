<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523123703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_user DROP FOREIGN KEY FK_6D435AD93AF59F2F');
        $this->addSql('DROP TABLE blog_role');
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01D4B986E16');
        $this->addSql('DROP INDEX IDX_BA5AE01D4B986E16 ON blog_post');
        $this->addSql('ALTER TABLE blog_post DROP blog_user_id, CHANGE description description VARCHAR(255) NOT NULL, CHANGE picture picture VARCHAR(1000) DEFAULT NULL, CHANGE name title VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_6D435AD93AF59F2F ON blog_user');
        $this->addSql('ALTER TABLE blog_user ADD roles JSON NOT NULL, ADD phone VARCHAR(255) NOT NULL, DROP telephone, CHANGE email email VARCHAR(180) NOT NULL, CHANGE blog_role_id blog_post_id INT NOT NULL');
        $this->addSql('ALTER TABLE blog_user ADD CONSTRAINT FK_6D435AD9A77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id)');
        $this->addSql('CREATE INDEX IDX_6D435AD9A77FBEAF ON blog_user (blog_post_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON blog_user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE blog_post ADD blog_user_id INT NOT NULL, CHANGE description description VARCHAR(1000) NOT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL, CHANGE title name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D4B986E16 FOREIGN KEY (blog_user_id) REFERENCES blog_user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BA5AE01D4B986E16 ON blog_post (blog_user_id)');
        $this->addSql('ALTER TABLE blog_user DROP FOREIGN KEY FK_6D435AD9A77FBEAF');
        $this->addSql('DROP INDEX IDX_6D435AD9A77FBEAF ON blog_user');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON blog_user');
        $this->addSql('ALTER TABLE blog_user ADD telephone VARCHAR(10) NOT NULL, DROP roles, DROP phone, CHANGE email email VARCHAR(255) NOT NULL, CHANGE blog_post_id blog_role_id INT NOT NULL');
        $this->addSql('ALTER TABLE blog_user ADD CONSTRAINT FK_6D435AD93AF59F2F FOREIGN KEY (blog_role_id) REFERENCES blog_role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6D435AD93AF59F2F ON blog_user (blog_role_id)');
    }
}
