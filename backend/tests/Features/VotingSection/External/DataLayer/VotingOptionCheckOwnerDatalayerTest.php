<?php

namespace Features\VotingSection\External\DataLayer;

use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\VotingOptionCheckOwnerDatalayer;
use PHPUnit\Framework\TestCase;

class VotingOptionCheckOwnerDatalayerTest extends TestCase
{

    public function testShouldReturnTrueIfTheUserUUidIsOwnerOfVotingOptionUuid(): void
    {
        $dataLayer = new VotingOptionCheckOwnerDatalayer(MemorySqliteConnection::getConnection(), '');
        self::assertTrue($dataLayer('e10fc30f-4d32-4e18-a566-d2ee07cd6d97', 'a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc'));
    }

    public function testShouldReturnFalseIfTheUserUUidIsOwnerOfVotingOptionUuid(): void
    {
        $dataLayer = new VotingOptionCheckOwnerDatalayer(MemorySqliteConnection::getConnection(), '');
        self::assertFalse($dataLayer('e10fc30f-4d32-4e18-a566-d2ee07cd6d97', '189b3c9d-ec15-43dc-b37b-d3893aa664c21'));
    }
}
