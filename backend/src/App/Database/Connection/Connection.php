<?php


namespace Rodri\VotingApp\App\Database\Connection\Connection;


use PDO;

interface Connection
{
    public static function getConnection(): PDO;
}