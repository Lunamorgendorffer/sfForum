<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240702194330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message ADD topic_id INT NOT NULL, ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1F55203D FOREIGN KEY (topic_id) REFERENCES topic (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9395C3F3 FOREIGN KEY (customer_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F1F55203D ON message (topic_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F9395C3F3 ON message (customer_id)');
        $this->addSql('ALTER TABLE topic ADD visitor_id INT NOT NULL, ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1B70BEE6D FOREIGN KEY (visitor_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_9D40DE1B70BEE6D ON topic (visitor_id)');
        $this->addSql('CREATE INDEX IDX_9D40DE1B12469DE2 ON topic (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1F55203D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F9395C3F3');
        $this->addSql('DROP INDEX IDX_B6BD307F1F55203D ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F9395C3F3 ON message');
        $this->addSql('ALTER TABLE message DROP topic_id, DROP customer_id');
        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1B70BEE6D');
        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1B12469DE2');
        $this->addSql('DROP INDEX IDX_9D40DE1B70BEE6D ON topic');
        $this->addSql('DROP INDEX IDX_9D40DE1B12469DE2 ON topic');
        $this->addSql('ALTER TABLE topic DROP visitor_id, DROP category_id');
    }
}
