<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180516082258 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book (id_book INT AUTO_INCREMENT NOT NULL, id_category INT NOT NULL, id_seller INT DEFAULT NULL, id_feedback INT DEFAULT NULL, ISBN VARCHAR(13) NOT NULL, title VARCHAR(32) NOT NULL, author VARCHAR(56) NOT NULL, editor VARCHAR(24) NOT NULL, published_at DATETIME NOT NULL, description LONGTEXT NOT NULL, nb_page INT DEFAULT NULL, size VARCHAR(24) DEFAULT NULL, weight NUMERIC(4, 2) DEFAULT NULL, INDEX IDX_CBE5A3315697F554 (id_category), INDEX IDX_CBE5A331DD2D6611 (id_seller), INDEX IDX_CBE5A33182F2A8CD (id_feedback), PRIMARY KEY(id_book)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library_possessed (id_book INT NOT NULL, id_user INT NOT NULL, INDEX IDX_7911BCDC40C5BF33 (id_book), INDEX IDX_7911BCDC6B3CA4B (id_user), PRIMARY KEY(id_book, id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library_desired (id_book INT NOT NULL, id_user INT NOT NULL, INDEX IDX_3D11355A40C5BF33 (id_book), INDEX IDX_3D11355A6B3CA4B (id_user), PRIMARY KEY(id_book, id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id_category INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(16) NOT NULL, sub_category_name VARCHAR(16) NOT NULL, PRIMARY KEY(id_category)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id_feedback INT AUTO_INCREMENT NOT NULL, comment LONGTEXT NOT NULL, published_at DATETIME NOT NULL, PRIMARY KEY(id_feedback)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seller (id_seller INT AUTO_INCREMENT NOT NULL, seller_name VARCHAR(16) NOT NULL, seller_url VARCHAR(255) NOT NULL, PRIMARY KEY(id_seller)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3315697F554 FOREIGN KEY (id_category) REFERENCES category (id_category)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331DD2D6611 FOREIGN KEY (id_seller) REFERENCES seller (id_seller)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33182F2A8CD FOREIGN KEY (id_feedback) REFERENCES feedback (id_feedback)');
        $this->addSql('ALTER TABLE library_possessed ADD CONSTRAINT FK_7911BCDC40C5BF33 FOREIGN KEY (id_book) REFERENCES book (id_book)');
        $this->addSql('ALTER TABLE library_possessed ADD CONSTRAINT FK_7911BCDC6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE library_desired ADD CONSTRAINT FK_3D11355A40C5BF33 FOREIGN KEY (id_book) REFERENCES book (id_book)');
        $this->addSql('ALTER TABLE library_desired ADD CONSTRAINT FK_3D11355A6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE library_possessed DROP FOREIGN KEY FK_7911BCDC40C5BF33');
        $this->addSql('ALTER TABLE library_desired DROP FOREIGN KEY FK_3D11355A40C5BF33');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3315697F554');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33182F2A8CD');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331DD2D6611');
        $this->addSql('ALTER TABLE library_possessed DROP FOREIGN KEY FK_7911BCDC6B3CA4B');
        $this->addSql('ALTER TABLE library_desired DROP FOREIGN KEY FK_3D11355A6B3CA4B');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE library_possessed');
        $this->addSql('DROP TABLE library_desired');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE seller');
        $this->addSql('DROP TABLE user');
    }
}
