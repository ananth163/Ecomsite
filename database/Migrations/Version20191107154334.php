<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Creates required tables at start of the Project
 */
final class Version20191107154334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creating required tables for the project';
    }

    public function up(Schema $schema) : void
    {
        // Abort if database is not MySQL
        
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        try {

        $productsTable = 'CREATE TABLE IF NOT EXISTS products
          (
          id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
          name VARCHAR(255) NOT NULL UNIQUE,
          price FLOAT(16),
          description TEXT,
          quantity INT(6) UNSIGNED, 
          category_id INT UNSIGNED,
          sub_category_id INT UNSIGNED,
          image_path VARCHAR(255),
          featured BOOLEAN,
          created_at TIMESTAMP NULL DEFAULT NULL,
          updated_at TIMESTAMP NULL DEFAULT NULL,
          deleted_at TIMESTAMP NULL DEFAULT NULL
        )';

        $categoriesTable = 'CREATE TABLE IF NOT EXISTS categories
          (
          id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
          name VARCHAR(255) NOT NULL UNIQUE,
          slug VARCHAR(255),
          created_at TIMESTAMP NULL DEFAULT NULL,
          updated_at TIMESTAMP NULL DEFAULT NULL,
          deleted_at TIMESTAMP NULL DEFAULT NULL
        )';

        $subCategoriesTable = 'CREATE TABLE IF NOT EXISTS sub_categories
          (
          id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
          name VARCHAR(255) NOT NULL UNIQUE,
          slug VARCHAR(255),
          category_id INT(11) UNSIGNED,
          created_at TIMESTAMP NULL DEFAULT NULL,
          updated_at TIMESTAMP NULL DEFAULT NULL,
          deleted_at TIMESTAMP NULL DEFAULT NULL
        )';

        $ordersTable = 'CREATE TABLE IF NOT EXISTS orders
          (
          id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
          user_id INT(11),
          product_id INT(11),
          unit_price FLOAT(16),
          total FLOAT(16),
          status VARCHAR(255),
          order_no VARCHAR(255),
          created_at TIMESTAMP NULL DEFAULT NULL,
          updated_at TIMESTAMP NULL DEFAULT NULL,
          deleted_at TIMESTAMP NULL DEFAULT NULL
        )';

        $paymentsTable = 'CREATE TABLE IF NOT EXISTS payments
          (
          id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
          user_id INT(11),
          order_no VARCHAR(255),
          amount FLOAT(16) UNSIGNED,
          status VARCHAR(255),
          created_at TIMESTAMP NULL DEFAULT NULL,
          updated_at TIMESTAMP NULL DEFAULT NULL,
          deleted_at TIMESTAMP NULL DEFAULT NULL
        )';

        $usersTable = 'CREATE TABLE IF NOT EXISTS users
          (
          id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
          username VARCHAR(255) NOT NULL UNIQUE,
          fullname VARCHAR(255),
          email VARCHAR(255),
          password VARCHAR(255),
          address TEXT,
          role VARCHAR(50),
          created_at TIMESTAMP NULL DEFAULT NULL,
          updated_at TIMESTAMP NULL DEFAULT NULL,
          deleted_at TIMESTAMP NULL DEFAULT NULL
        )';

        // Creating products Table
        $this->addSql($productsTable);
        
        // Creating categories Table
        $this->addSql($categoriesTable);

        // Creating sub_categories Table
        $this->addSql($subCategoriesTable);

        // Creating orders Table
        $this->addSql($ordersTable);

        // Creating payments Table
        $this->addSql($paymentsTable);

        // Creating users Table
        $this->addSql($usersTable);

        } catch (Exception $e) {

            $this->write(" An error occurred while creating required Tables  {$e->getMessage()}");
        }

    }

    public function down(Schema $schema) : void
    {
        // Abort if Database is not MySQL

        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        try{

        // Drop products Table
        $this->write("Dropping products Table...");
        $schema->dropTable('products');

        // Drop categories Table
        $this->write("Dropping categories Table...");
        $schema->dropTable('categories');

        // Drop sub_categories Table
        $this->write("Dropping sub_categories Table...");
        $schema->dropTable('sub_categories');

        // Drop orders Table
        $this->write("Dropping orders Table...");
        $schema->dropTable('orders');

        // Drop payments Table
        $this->write("Dropping payments Table...");
        $schema->dropTable('payments');

        // Drop users Table
        $this->write("Dropping users Table...");
        $schema->dropTable('users');

        } catch( Exception $e) {

            $this->write("An error occurred:  {$e->getMessage()}");
        }
    }
}

