<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321064505 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscrits CHANGE competition_id competition_id INT DEFAULT NULL, CHANGE categorieage_id categorieage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu_static_emplacement CHANGE priority priority NUMERIC(2, 1) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_users CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE telephone_portable telephone_portable INT DEFAULT NULL, CHANGE telephone_fixe telephone_fixe INT DEFAULT NULL, CHANGE email_canonical email_canonical VARCHAR(255) DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE last_visit last_visit DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE activite CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE photo CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE competition_id competition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu_static CHANGE emplacement_id emplacement_id INT DEFAULT NULL, CHANGE lastmod lastmod DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE competition CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE actualite CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activite CHANGE image image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE actualite CHANGE image image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE app_users CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE last_visit last_visit DATETIME DEFAULT \'NULL\', CHANGE telephone_portable telephone_portable INT DEFAULT NULL, CHANGE telephone_fixe telephone_fixe INT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE email_canonical email_canonical VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE competition CHANGE image image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE contenu_static CHANGE emplacement_id emplacement_id INT DEFAULT NULL, CHANGE lastmod lastmod DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE contenu_static_emplacement CHANGE priority priority NUMERIC(2, 1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE evenement CHANGE image image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE inscrits CHANGE competition_id competition_id INT DEFAULT NULL, CHANGE categorieage_id categorieage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE competition_id competition_id INT DEFAULT NULL');
    }
}
