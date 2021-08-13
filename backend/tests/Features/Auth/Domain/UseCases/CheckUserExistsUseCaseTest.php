<?php

namespace Features\Auth\Domain\UseCases;

use Rodri\VotingApp\Features\Auth\Domain\Repositories\ICheckUserExistsRepository;
use Rodri\VotingApp\Features\Auth\Domain\UseCases\CheckUserExistsUseCase;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;

class CheckUserExistsUseCaseTest extends TestCase
{
    public function testShouldReturnTrueIfUserExists(): void
    {
        $repository = self::createMock(ICheckUserExistsRepository::class);
        $repository->method('__invoke')
            ->willReturn(true);

        $useCase = new CheckUserExistsUseCase($repository);
        self::assertTrue($useCase(new UserUuid('any')));
    }
}
