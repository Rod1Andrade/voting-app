<?php

namespace Features\VotingSection\Infra\Repositories;

use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IShowVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\ShowVotingSectionRepositoryException;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\ShowVotingSectionRepository;

class ShowVotingSectionRepositoryTest extends TestCase
{

    public function testShouldGetAVotingSectionByVotingUuid(): void
    {
        $dummyData = new stdClass();
        $dummyData->userUuid = 'any-user-uuid-gen-for-test';
        $dummyData->votingUuid = 'any-uuid-gen-for-test';
        $dummyData->subject = 'test';
        $dummyData->startDate = 'now';
        $dummyData->finishDate = 'tomorrow';
        $dummyData->votingOptions = [
            'first option',
            'second option',
            'third option'
        ];


        $dataLayer = self::createMock(IShowVotingSectionDataLayer::class);
        $dataLayer->method('__invoke')
            ->willReturn(VotingDTO::createVotingDTOfromStdClass($dummyData));

        $repository = new ShowVotingSectionRepository($dataLayer);

        self::assertInstanceOf(Voting::class, $repository(new VotingUuid('any')));
    }

    public function testShouldThrowAShowVotingSectionRepositoryExceptionWhenIsNotPossibleReturnIt(): void
    {
        self::expectException(ShowVotingSectionRepositoryException::class);

        $dataLayer = self::createMock(IShowVotingSectionDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new Exception());

        $repository = new ShowVotingSectionRepository($dataLayer);

        $repository(new VotingUuid('any'));
    }

}
