<?php

namespace Features\VotingSection\Domain\UseCases;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\VotingOptionCheckOwnerException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IVotingOptionCheckOwnerRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\VotingOptionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

class VotingOptionCheckOwnerUseCaseTest extends TestCase
{

    public function testShouldReturnTrueIfThePassedYourUuidIsOwnerOfVotingOptionUuid(): void
    {
        $repository = self::createMock(IVotingOptionCheckOwnerRepository::class);
        $repository->method('__invoke')
            ->willReturn(true);

        $useCase = new VotingOptionCheckOwnerUseCase($repository);
        self::assertTrue($useCase(new VotingOptionUuid('any'), new UserUuid('any')));
    }

    public function testShouldThowAVotingOptionCheckOnwerExceptionWhenItsNotPossibleUseTheRepositoryResources(): void
    {
        self::expectException(VotingOptionCheckOwnerException::class);

        $repository = self::createMock(IVotingOptionCheckOwnerRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $useCase = new VotingOptionCheckOwnerUseCase($repository);
        $useCase(new VotingOptionUuid('any'), new UserUuid('any'));
    }
    
}
