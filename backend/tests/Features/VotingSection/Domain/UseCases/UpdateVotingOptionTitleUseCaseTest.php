<?php

namespace Features\VotingSection\Domain\UseCases;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\UpdateVotingTitleException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IUpdateVotingOptionTitleRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IVotingOptionCheckOwnerUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\UpdateVotingOptionTitleUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

class UpdateVotingOptionTitleUseCaseTest extends TestCase
{
    public function testShouldThrowAUpdateVotingTitleExceptionWhenIsNotPossibleUpdate(): void
    {
        self::expectException(UpdateVotingTitleException::class);

        $repository = self::createMock(IUpdateVotingOptionTitleRepository::class);
        $repository->method('__invoke')
            ->willThrowException(new Exception());

        $checkOwnerUseCase = self::createMock(IVotingOptionCheckOwnerUseCase::class);
        $checkOwnerUseCase->method('__invoke')
            ->willReturn(true);

        $useCase = new UpdateVotingOptionTitleUseCase($checkOwnerUseCase, $repository);

        $useCase(new Title('any'), new VotingOptionUuid(Uuid::genUUIDv4()), new UserUuid('any'));
    }

    public function testShouldThrowAUpdateVotingTitleExceptionWhenHasAInvalidUuid(): void
    {
        self::expectException(UpdateVotingTitleException::class);

        $repository = self::createMock(IUpdateVotingOptionTitleRepository::class);

        $checkOwnerUseCase = self::createMock(IVotingOptionCheckOwnerUseCase::class);
        $checkOwnerUseCase->method('__invoke')
            ->willReturn(true);

        $useCase = new UpdateVotingOptionTitleUseCase($checkOwnerUseCase, $repository);

        $useCase(new Title('any'), new VotingOptionUuid('invalid-uuid'), new UserUuid('any'));
    }

    public function testShouldThrowAUpdateVotingTitleExceptionWhenIsNotOwner(): void
    {
        self::expectException(UpdateVotingTitleException::class);

        $repository = self::createMock(IUpdateVotingOptionTitleRepository::class);

        $checkOwnerUseCase = self::createMock(IVotingOptionCheckOwnerUseCase::class);
        $checkOwnerUseCase->method('__invoke')
            ->willReturn(false);

        $useCase = new UpdateVotingOptionTitleUseCase($checkOwnerUseCase, $repository);

        $useCase(new Title('any'), new VotingOptionUuid(Uuid::genUUIDv4()), new UserUuid('any'));
    }
}
