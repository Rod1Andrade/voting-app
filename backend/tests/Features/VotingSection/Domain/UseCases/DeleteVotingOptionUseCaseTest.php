<?php

namespace Features\VotingSection\Domain\UseCases;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\DeleteVotingOptionException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IDeleteVotingOptionRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\DeleteVotingOptionUseCase;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

class DeleteVotingOptionUseCaseTest extends TestCase
{
    public function testShouldThrowADeleteVotingOptionExceptionWhenItsNotPossibleDeleteOne()
    {
        self::expectException(DeleteVotingOptionException::class);

        $repository = self::createMock(IDeleteVotingOptionRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new \Exception());

        $useCase = new DeleteVotingOptionUseCase($repository);

        $useCase(new VotingOptionUuid('any'), new UserUuid('any'));
    }
}
