<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250113135344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__purchase AS SELECT purchase_identifier, customer_id, product_id, quantity, price, currency, date FROM purchase');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('CREATE TABLE purchase (purchase_identifier VARCHAR(10) NOT NULL, customer_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, currency VARCHAR(10) NOT NULL, date DATE NOT NULL, PRIMARY KEY(purchase_identifier))');
        $this->addSql('INSERT INTO purchase (purchase_identifier, customer_id, product_id, quantity, price, currency, date) SELECT purchase_identifier, customer_id, product_id, quantity, price, currency, date FROM __temp__purchase');
        $this->addSql('DROP TABLE __temp__purchase');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__purchase AS SELECT purchase_identifier, customer_id, product_id, quantity, price, currency, date FROM purchase');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('CREATE TABLE purchase (purchase_identifier VARCHAR(10) NOT NULL, customer_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, price NUMERIC(10, 2) NOT NULL, currency VARCHAR(10) NOT NULL, date DATE NOT NULL, PRIMARY KEY(purchase_identifier))');
        $this->addSql('INSERT INTO purchase (purchase_identifier, customer_id, product_id, quantity, price, currency, date) SELECT purchase_identifier, customer_id, product_id, quantity, price, currency, date FROM __temp__purchase');
        $this->addSql('DROP TABLE __temp__purchase');
    }
}
