<?php

namespace Features\VotingSection\Domain\UseCases;

use PHPUnit\Framework\TestCase;
use PHPUnit\Util\Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\DeleteVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IDeleteVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\DeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class DeleteVotingSectionUseCaseTest extends TestCase
{
    public function testShouldThrowADeleteVotingSectionExceptionWhenIsNotPossibleDeleteOne(): void
    {
        self::expectException(DeleteVotingSectionException::class);

        $repositoy = self::createMock(IDeleteVotingSectionRepository::class);
        $repositoy->method('__invoke')
            ->willThrowException(new Exception());

        $usecase = new DeleteVotingSectionUseCase($repositoy);
        $usecase(new VotingUuid('any'));
    }

    public function testShouldThrowADeleteVotingSectionExceptionWhenIsNotPresentTheVotingUUid(): void
    {
        self::expectExceptionMessage('The voting uuid its necessary.');

        $repositoy = self::createMock(IDeleteVotingSectionRepository::class);

        $usecase = new DeleteVotingSectionUseCase($repositoy);
        $usecase(new VotingUuid(''));
    }
}