<?php

namespace Features\VotingSection\External\DataLayer;

use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\ShowAllVotingSectionsDataLayer;

class ShowAllVotingSectionsDataLayerTest extends TestCase
{

    public function testShouldReturnAllVotingSections(): void
    {
        $dataLayer = new ShowAllVotingSectionsDataLayer(MemorySqliteConnection::getConnection(), '');
        self::assertIsArray($dataLayer(0, 10));
    }

}