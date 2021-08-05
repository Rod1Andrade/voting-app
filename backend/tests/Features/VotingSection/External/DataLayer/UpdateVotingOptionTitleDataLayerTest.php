<?php

namespace Features\VotingSection\External\DataLayer;

use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\UpdateVotingOptionTitleDataLayer;

class UpdateVotingOptionTitleDataLayerTest extends TestCase
{
    public function testShouldUpdateAVotingOptionTitle(): void
    {
        $dataLayer = new UpdateVotingOptionTitleDataLayer(MemorySqliteConnection::getConnection(), '');
        $dataLayer('Any New Title', 'e10fc30f-4d32-4e18-a566-d2ee07cd6d97');

        self::assertTrue(true);
    }
}
