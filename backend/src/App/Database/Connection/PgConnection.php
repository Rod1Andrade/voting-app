<?php


namespace Rodri\VotingApp\App\Database\Connection;


use PDO;

/**
 * Connection - PgConnection
 * @package Rodri\VotingApp\App\Database
 * @author Rodrigo Andrade
 */
class PgConnection implements Connection
{

    /**
     *
     */
    private const OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    /**
     * @var PDO|null
     */
    private static ?PDO $pdoInstance;

    /**
     * Private constructor to maintain singleton pattern.
     */
    private function __construct()
    {
    }

    /**
     * Private clone to maintain singleton pattern.
     */
    private function __clone(): void
    {
    }

    /**
     * Get Single Postgres PDO connection.
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if (!self::$pdoInstance) {
            self::$pdoInstance = new PDO(
                getenv('DB_DNS'),
                getenv('DB_USER_NAME'),
                getenv('DB_USER_PASS'),
                self::OPTIONS,
            );
        }

        return self::$pdoInstance;
    }
}