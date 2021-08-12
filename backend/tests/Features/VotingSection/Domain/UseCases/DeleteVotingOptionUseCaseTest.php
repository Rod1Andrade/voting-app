<?php

namespace Features\VotingSection\Domain\UseCases;

use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\DeleteVotingOptionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IDeleteVotingOptionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\DeleteVotingOptionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IVotingOptionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

class DeleteVotingOptionUseCaseTest extends TestCase
{
    public function testShouldThrowADeleteVotingOptionExceptionWhenItsNotPossibleDeleteOne()
    {
        self::expectException(DeleteVotingOptionException::class);

        $checkOwnerUseCase = self::createMock(IVotingOptionCheckOwnerUseCase::class);
        $checkOwnerUseCase->method('__invoke')
            ->willReturn(true);

        $repository = self::createMock(IDeleteVotingOptionRepository::class);
        $repository->method('__invoke')
          ->willThrowException(new \Exception());

        $useCase = new DeleteVotingOptionUseCase($checkOwnerUseCase, $repository);
        $useCase(new VotingOptionUuid('any'), new UserUuid('any'));
    }
}
