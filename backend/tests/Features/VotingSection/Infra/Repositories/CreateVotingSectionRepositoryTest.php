<?php


namespace Features\VotingSection\Infra\Repositories;


use DateTime;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\VotingOption;
use Rodri\VotingApp\Features\VotingSection\Domain\Factories\VotingFactory;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\CreateVotingSectionDataLayerException;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\CreateVotingSectionRepository;
use RuntimeException;

class CreateVotingSectionRepositoryTest extends TestCase
{

    public function testShouldThrowACreateVotingSectionDataLayerExceptionWhenIsNotPossibleCreateOne(): void
    {
        self::expectException(CreateVotingSectionDataLayerException::class);
        $dataLayer = self::createMock(ICreateVotingSectionDataLayer::class);

        $dataLayer->method('__invoke')
            ->willThrowException(new RuntimeException());

        $repository = new CreateVotingSectionRepository($dataLayer);

        $repository(VotingFactory::create(
            'a55f1a8d-ccfd-4a9a-9ab1-714efe85f5bc',
            'Any Subject',
            new DateTime('now'),
            new DateTime('tomorrow'),
            [
                new VotingOption(title: new Title('any title')),
                new VotingOption(title: new Title('any title')),
                new VotingOption(title: new Title('any title')),
            ]
        ));
    }
}
