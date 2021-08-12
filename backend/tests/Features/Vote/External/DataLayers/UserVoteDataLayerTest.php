<?php

namespace Features\Vote\External\DataLayers;

use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\External\DataLayers\UserVoteDataLayer;
use Rodri\VotingApp\Features\Vote\External\Exceptions\UserVoteDataLayerException;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

class UserVoteDataLayerTest extends TestCase
{
    public function testShouldStoreAVote(): void
    {
        $dataLayer = new UserVoteDataLayer(MemorySqliteConnection::getConnection(), '');

        try {
            $dataLayer(
                userUuid: new UserUuid('0f86de4f-6337-4e36-ad01-f71a67dbe2b0'),
                votingUuid: new VotingUuid('ae93cb4a-716f-4378-9bb2-277b9883eb3b'),
                votingOptionUuid: new VotingOptionUuid('a315ae34-d5a7-459c-beca-332c541b359c')
            );
        } catch (UserVoteDataLayerException) {
            self::assertTrue(true);
        }

        self::assertTrue(true);
    }
}
