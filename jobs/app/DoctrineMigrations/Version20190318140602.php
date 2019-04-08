<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318140602 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE job (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', zipcode_id VARCHAR(255) NOT NULL, service_id VARCHAR(255) NOT NULL, title VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, date_to_be_done DATE NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FBD8E0F8ED5CA9E6 (service_id), INDEX IDX_FBD8E0F8E4C7FA21 (zipcode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zipcode (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', code VARCHAR(5) NOT NULL, city VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8E4C7FA21 FOREIGN KEY (zipcode_id) REFERENCES zipcode (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8ED5CA9E6');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8E4C7FA21');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE zipcode');
    }
}
