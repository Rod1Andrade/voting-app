<?php

namespace Features\VotingSection\External\DataLayer;

use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\ShowVotingSectionDataLayer;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;

class ShowVotingSectionDataLayerTest extends TestCase
{

    public function testShouldReturnAVotingDTOFromMemoryDataBasePassedAUuid(): void
    {
        $dataLayer = new ShowVotingSectionDataLayer(MemorySqliteConnection::getConnection(), '');
        $response = $dataLayer(new VotingUuid('efcfbc04-fa06-466e-8077-9ec1eaf1f2af'));

        self::assertInstanceOf(VotingDTO::class, $response);
    }

    public function testShouldReturnNullIfTheValuesNotExists(): void
    {
        $dataLayer = new ShowVotingSectionDataLayer(MemorySqliteConnection::getConnection(), '');

        self::assertNull($dataLayer(new VotingUuid('efcfbc04-fa06-466e-8077-9ec1eaf1f2af-test')));
    }
}
