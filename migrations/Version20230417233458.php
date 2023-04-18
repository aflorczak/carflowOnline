<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417233458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(50) NOT NULL, clients_data VARCHAR(255) NOT NULL, principal VARCHAR(50) NOT NULL, internal_case_number VARCHAR(255) NOT NULL, external_case_number VARCHAR(255) NOT NULL, proposed_segment VARCHAR(50) NOT NULL, delivery_address VARCHAR(255) NOT NULL, delivery_date DATE NOT NULL, delivery_time TIME NOT NULL, delivery_comments VARCHAR(255) NOT NULL, delivery_branch VARCHAR(255) NOT NULL, returned_address VARCHAR(255) NOT NULL, returned_date DATE NOT NULL, returned_time TIME NOT NULL, returned_comments VARCHAR(255) NOT NULL, returned_branch VARCHAR(255) NOT NULL, reason_for_cancelling_the_order LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `order`');
    }
}
