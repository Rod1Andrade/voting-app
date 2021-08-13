<?php

namespace Rodri\VotingApp\Features\VotingSection\Domain\UseCases;

use Exception;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\ShowAllVotingSectionsException;
use Rodri\VotingApp\Features\VotingSection\Domain\Repositories\IShowAllVotingSectionsRepository;

/**
 * ShowAllVotingSectionsUseCase
 * @package Rodri\VotingApp\Features\VotingSection\Domain\UseCases
 * @author Rodrigo Andrade
 */
class ShowAllVotingSectionsUseCase implements IShowAllVotingSectionsUseCase
{

    public function __construct(
        private IShowAllVotingSectionsRepository $repository
    )
    {
    }

    public function __invoke(int $offset = 0, int $limit = 10): array
    {
        try {
            return ($this->repository)($offset, $limit);
        } catch (Exception) {
            throw new ShowAllVotingSectionsException('It\'s not Possible take all voting section use cases.');
        }
    }
}