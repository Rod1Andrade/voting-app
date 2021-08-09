<?php

namespace Features\Vote\External\DataLayers;

use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\External\DataLayers\CheckUserAlreadyVoteDataLayer;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class CheckUserAlreadyVoteDataLayerTest extends TestCase
{
    public function testShouldAssertTrueWhenExistsTheRelationVoteUser(): void
    {
        $userUuid = new UserUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0');
        $votingUuid = new VotingUuid('ae93cb4a-716f-4378-9bb2-277b9883eb3b');

        $dataLayer = new CheckUserAlreadyVoteDataLayer(MemorySqliteConnection::getConnection(), '');

        self::assertTrue($dataLayer($userUuid, $votingUuid));
    }


    public function testShouldAssertFalseWhenNotExistsTheRelationVoteUser(): void
    {
        $userUuid = new UserUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0');
        $votingUuid = new VotingUuid('073ef90b-df84-415e-98da-4fb5766e7d35');

        $dataLayer = new CheckUserAlreadyVoteDataLayer(MemorySqliteConnection::getConnection(), '');

        self::assertFalse($dataLayer($userUuid, $votingUuid));
    }
}
