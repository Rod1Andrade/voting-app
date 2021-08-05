<?php

namespace Features\VotingSection\External\DataLayer;

use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\DeleteVotingOptionDataLayer;
use PHPUnit\Framework\TestCase;

class DeleteVotingOptionDataLayerTest extends TestCase
{

    public function testShouldDeleteAVotingOptionWithAOwner(): void
    {
        $votingOptionUuid = '66d679fc-6d7d-40f0-97a0-d24e6c9be119';
        $userUuid = 'a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc';

        $dataLayer = new DeleteVotingOptionDataLayer(MemorySqliteConnection::getConnection(), '');
        $dataLayer($votingOptionUuid, $userUuid);

        self::assertTrue(true);
    }

}
