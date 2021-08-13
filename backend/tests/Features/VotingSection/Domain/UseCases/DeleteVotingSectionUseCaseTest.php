<?php

namespace Features\VotingSection\Domain\UseCases;

use PHPUnit\Framework\TestCase;
use PHPUnit\Util\Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IVotingSectionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\DeleteVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IDeleteVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\DeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;

class DeleteVotingSectionUseCaseTest extends TestCase
{
    public function testShouldThrowADeleteVotingSectionExceptionWhenIsNotPossibleDeleteOne(): void
    {
        self::expectException(DeleteVotingSectionException::class);
        $votingSectionCheckOwnerUseCase = self::createMock(IVotingSectionCheckOwnerUseCase::class);
        $votingSectionCheckOwnerUseCase->method('__invoke')
            ->willReturn(true);

        $repository = self::createMock(IDeleteVotingSectionRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new DeleteVotingSectionUseCase($votingSectionCheckOwnerUseCase, $repository);
        $useCase(new VotingUuid('any'), new UserUuid('any'));
    }

    public function testShouldThrowADeleteVotingSectionExceptionWhenIsNotPresentTheVotingUUid(): void
    {
        self::expectExceptionMessage('The voting uuid its necessary.');
        $votingSectionCheckOwnerUseCase = self::createMock(IVotingSectionCheckOwnerUseCase::class);
        $votingSectionCheckOwnerUseCase->method('__invoke')
            ->willReturn(true);
        $repository = self::createMock(IDeleteVotingSectionRepository::class);

        $useCase = new DeleteVotingSectionUseCase($votingSectionCheckOwnerUseCase, $repository);
        $useCase(new VotingUuid(''), new UserUuid('any'));
    }
}
