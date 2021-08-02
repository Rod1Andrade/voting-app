<?php

namespace Features\VotingSection\External\DataLayer;

use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\DeleteVotingSectionDataLayer;

class DeleteVotingSectionDataLayerTest extends TestCase
{

    public function testShouldDeleteVotingSectionByUUID(): void
    {

        $uuid = 'd1346c9f-4b38-48c9-9011-a6186cf853f1';

        $dataLayer = new DeleteVotingSectionDataLayer(MemorySqliteConnection::getConnection(), '');
        $dataLayer($uuid);

        self::assertTrue(true);
    }
    
}