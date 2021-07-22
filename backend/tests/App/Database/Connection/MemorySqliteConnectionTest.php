<?php


namespace App\Database\Connection;


use PDO;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;

class MemorySqliteConnectionTest extends TestCase
{

    public function testConnection(): void
    {
        self::assertInstanceOf(PDO::class, MemorySqliteConnection::getConnection()->pdo());
    }

}