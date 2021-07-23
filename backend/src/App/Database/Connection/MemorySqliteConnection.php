<?php


namespace Rodri\VotingApp\App\Database\Connection;


use PDO;

/**
 * Class MemorySqliteConnection
 * @package Rodri\VotingApp\App\Database\Connection
 * @author Rodrigo Andrade
 */
class MemorySqliteConnection extends Connection
{
    public static function getConnection(): Connection
    {
        if (!self::$instance)
            self::$instance = new MemorySqliteConnection();

        return self::$instance;
    }

    public function pdo(): PDO
    {
        if (!self::getConnection()->pdoInstance) {
            !self::getConnection()->pdoInstance = new PDO(
                'sqlite:' . __DIR__ . '/../../../../storage/db/memory_sqlite.sq3',
                null, null,
                self::OPTIONS
            );
        }

        return self::getConnection()->pdoInstance;
    }
}