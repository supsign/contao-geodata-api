<?php

namespace Supsign\ContaoGeoDataApiBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;


class SupsignCredential extends AbstractMigration
{
    /**
     * @var Connection
     */
    private $connection;
    private $schemaManager;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->schemaManager = $connection->getSchemaManager();
    }

    public function shouldRun(): bool
    {
        if ($this->schemaManager->tablesExist(['tl_supsign_credential'])) {
            return false;
        }

        return true;
    }

    public function run(): MigrationResult
    {
        $this->connection->query(
            'CREATE TABLE 
                `tl_supsign_credential` ( 
                    `id` INT(10) NOT NULL AUTO_INCREMENT , 
                    `name` VARCHAR(255) NOT NULL , 
                    `client_id` VARCHAR(255) NOT NULL , 
                    `client_secret` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)
                )'
        )->execute();

        return new MigrationResult(
            true,
            'tiptop'
        );
    }
}
