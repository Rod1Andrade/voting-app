<?php


namespace Rodri\VotingApp\App\Database;


use PDO;

interface Connection
{
    public static function getConnection(): PDO;
}