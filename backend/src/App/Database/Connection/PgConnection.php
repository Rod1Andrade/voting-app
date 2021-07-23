<?php


namespace Rodri\VotingApp\App\Database\Connection;


use PDO;

/**
 * Connection - PgConnection
 * @package Rodri\VotingApp\App\Database
 * @author Rodrigo Andrade
 */
class PgConnection extends Connection
{
    /**
     * Take the connection instance
     * @return Connection
     */
    public static function getConnection(): Connection
    {
        if (empty(self::$instance))
            self::$instance = new PgConnection();

        return self::$instance;
    }

    /**
     * Get Single Postgres PDO connection.
     * @return PDO
     */
    public function pdo(): PDO
    {
        if (!self::getConnection()->pdoInstance) {
            !self::getConnection()->pdoInstance = new PDO(
                getenv('DB_DNS'),
                getenv('DB_USER_NAME'),
                getenv('DB_USER_PASS'),
                self::OPTIONS,
            );
        }

        return self::getConnection()->pdoInstance;
    }

    /**
     * Private constructor to maintain singleton pattern.
     * @codeCoverageIgnore
     */
    private function __construct()
    {
        parent::__construct();
    }

    /**
     * Private clone to maintain singleton pattern.
     * @codeCoverageIgnore
     */
    protected function __clone(): void
    {
        parent::__clone();
    }

}