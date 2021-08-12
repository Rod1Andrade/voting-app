<?php


namespace Features\VotingSection\External\DataLayer;


use DateTime;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\Factories\VotingFactory;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\CreateVotingOptionDataLayer;
use Rodri\VotingApp\Features\VotingSection\External\DataLayer\CreateVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;

class CreateVotingSectionDataLayerTest extends TestCase
{
    public function testShouldStoreAVotingWithOptions(): void
    {
        $votingOptionsDataLayer = new CreateVotingOptionDataLayer(MemorySqliteConnection::getConnection(), '');
        $dataLayer = new CreateVotingSectionDataLayer(MemorySqliteConnection::getConnection(), $votingOptionsDataLayer, '');

        $dataLayer(VotingDTO::createVotingDTOFromVoting(
            VotingFactory::create(
                'a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc',
                subject: 'Any',
                startDate: new DateTime('now'),
                finishDate: new DateTime('tomorrow'),
                votingOptions: [
                    new VotingOption(title: new Title('any option')), // TODO: VotingOptionFactory
                    new VotingOption(title: new Title('any second option')), // TODO: VotingOptionFactory
                    new VotingOption(title: new Title('any third option')), // TODO: VotingOptionFactory
                ],
            )
        ));

        self::assertTrue(true);
    }
}