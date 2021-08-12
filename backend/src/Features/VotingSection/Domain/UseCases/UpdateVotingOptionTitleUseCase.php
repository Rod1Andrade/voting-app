<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use InvalidArgumentException;
use Rodri\VotingApp\App\Adapters\Uuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\UpdateVotingTitleException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IUpdateVotingOptionTitleRepository;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;

/**
 * Use Case implementation - UpdateVotingOptionTitleUseCase
 * @author Rodrigo Andrade
 */
class UpdateVotingOptionTitleUseCase implements IUpdateVotingOptionTitleUseCase
{

    public function __construct(
        private IVotingOptionCheckOwnerUseCase $checkOwnerUseCase,
        private IUpdateVotingOptionTitleRepository $repository
    )
    {
    }

    public function __invoke(Title $title, VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): void
    {
        try {
            $this->validate($votingOptionUuid, $userUuid);
            
            ($this->repository)($title, $votingOptionUuid, $userUuid);
        } catch (UpdateVotingTitleException | InvalidArgumentException $e) {
            throw new UpdateVotingTitleException($e->getMessage());
        } catch (Exception) {
            throw new UpdateVotingTitleException('Unknown error');
        }
    }

    /**
     * @param VotingOptionUuid $votingOptionUuid
     * @param UserUuid $userUuid
     */
    private function validate(VotingOptionUuid $votingOptionUuid, UserUuid $userUuid): void
    {
        if (!Uuid::validate($votingOptionUuid->getValue())) {
            throw new UpdateVotingTitleException('Invalid UUID.');
        }

        if (!($this->checkOwnerUseCase)($votingOptionUuid, $userUuid)) {
            throw new InvalidArgumentException('To delete a voting option you need be the owner.');
        }
    }
}