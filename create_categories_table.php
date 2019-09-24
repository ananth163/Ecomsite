<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class CategoriesTableMigration extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Migrating Categories Table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $statement = 'CREATE TABLE IF NOT EXISTS products
          (
          id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
          name VARCHAR(255) NOT NULL UNIQUE,
          price FLOAT(16)
          description TEXT, 
          category_id INT UNSIGNED,
          sub_category_id INT UNSIGNED,
          image_path VARCHAR(255),
          created_at TIMESTAMP DEFAULT NULL,
          updated_at TIMESTAMP DEFAULT NULL,
          deleted_at TIMESTAMP DEFAULT NULL,
        )';

        $this->addSql($statement);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $schema->dropTable('products');

    }
}
