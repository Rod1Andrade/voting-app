<?php

namespace Features\VotingSection\Infra\Repositories;

use Exception;
use PHPUnit\Framework\TestCase;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\IUpdateVotingOptionTitleDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\UpdateVotingTitleRepositoryException;
use Rodri\VotingApp\Features\VotingSection\Infra\Repositories\UpdateVotingOptionTitleRepository;

class UpdateVotingOptionTitleRepositoryTest extends TestCase
{
    public function testShouldThrowAUpdateVotingOptionTitleRepositoryExceptionWhenIsNotPossibleDotIt(): void
    {
        self::expectException(UpdateVotingTitleRepositoryException::class);

        $dataLayer = self::createMock(IUpdateVotingOptionTitleDataLayer::class);
        $dataLayer->method('__invoke')
            ->willThrowException(new Exception());

        $repository = new UpdateVotingOptionTitleRepository($dataLayer);
        $repository(new Title('any'), new VotingOptionUuid('any'));
    }
}
