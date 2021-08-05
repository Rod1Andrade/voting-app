<?php

namespace Features\VotingSection\Infra\Repositories;

use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IVotingOptionCheckOwnerDatalayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\VotingOptionCheckOwnerRepository;
use PHPUnit\Framework\TestCase;

class VotingOptionCheckOwnerRepositoryTest extends TestCase
{

    public function testShouldReturnTrueIfIsATrulyOwner(): void
    {
        $datalayer = self::createMock(IVotingOptionCheckOwnerDatalayer::class);
        $datalayer->method('__invoke')
            ->willReturn(true);

        $repository = new VotingOptionCheckOwnerRepository($datalayer);
        self::assertTrue($repository(new VotingOptionUuid('any'), new UserUuid('any')));
    }
}
