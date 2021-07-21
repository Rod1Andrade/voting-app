<?php


namespace Rodri\VotingApp\App\Database\Connection\Connection;


use PDO;

/**
 * Interface Connection
 * @package Rodri\VotingApp\App\Database\Connection\Connection
 */
abstract class Connection
{
    protected static Connection $instance;
    protected ?PDO $pdoInstance;

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
     * Private constructor to maintain singleton pattern.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone to maintain singleton pattern.
     */
    protected function __clone(): void
    {
    }
}