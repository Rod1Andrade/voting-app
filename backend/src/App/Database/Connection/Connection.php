<?php


namespace Rodri\VotingApp\App\Database\Connection;


use PDO;

/**
 * Interface Connection
 * @package Rodri\VotingApp\App\Database\Connection\Connection
 */
abstract class Connection
{
    protected static ?Connection $instance = null;
    protected ?PDO $pdoInstance = null;

    protected const OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    /**
     * Get a connection
     * @return Connection
     */
    public abstract static function getConnection(): Connection;

    /**
     * Get Single Postgres PDO connection.
     * @return PDO
     */
    public abstract function pdo(): PDO;

    /**
     * Set the pdo instance.
     * @param PDO $pdo
     */
    public function setPdo(PDO $pdo): void
    {
        $this->pdoInstance = $pdo;
    }

    /**
     * Private constructor to maintain singleton pattern.
     * @codeCoverageIgnore
     */
    protected function __construct()
    {
    }

    /**
     * Private clone to maintain singleton pattern.
     * @codeCoverageIgnore
     */
    protected function __clone(): void
    {
    }
}