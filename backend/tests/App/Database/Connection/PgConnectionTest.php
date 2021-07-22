<?php


namespace App\Database\Connection;


use Dotenv\Dotenv;
use PDO;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\PgConnection;

class PgConnectionTest extends TestCase
{

    /**
     * @before
     */
    public function loadEnv(): void
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/../../../../src/App/Config');
        $dotenv->load();
    }

    public function testPgConnection(): void
    {
        self::assertInstanceOf(PDO::class, PgConnection::getConnection()->pdo());
    }
}