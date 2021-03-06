<?php


namespace Rodri\VotingApp\Features\VotingSection\Infra\Repositories;


use Rodri\VotingApp\Features\VotingSection\Domain\Entities\Voting;

use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\ICreateVotingSectionRepository;
use Rodri\VotingApp\Features\VotingSection\Infra\Datalayer\ICreateVotingSectionDataLayer;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use Rodri\VotingApp\Features\VotingSection\Infra\Exceptions\CreateVotingSectionDataLayerException;
use RuntimeException;

/**
 * Class CreatedVotingSectionRepository
 * @package Rodri\VotingApp\Features\VotingSection\Infra\Repositories
 * @author Rodrigo Andrade
 */
class CreateVotingSectionRepository implements ICreateVotingSectionRepository
{
    public function __construct(
        private ICreateVotingSectionDataLayer $dataLayer
    )
    {
    }

    public function __invoke(Voting $voting): void
    {
        try {
            ($this->dataLayer)(VotingSectionDTO::createVotingDTOFromVoting($voting));
        } catch (RuntimeException $e) {
            throw new CreateVotingSectionDataLayerException('Is not possible create a voting section');
        }
    }
}
