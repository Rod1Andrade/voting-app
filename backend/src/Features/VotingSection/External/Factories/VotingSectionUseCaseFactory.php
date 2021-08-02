<?php


namespace Rodri\VotingApp\Features\VotingSection\External\Factories;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ICreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\External\Facades\CreateVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\DeleteVotingSectionUseCaseFacade;

/**
 * Class VotingSectionUseCaseFactory0
 * @package Rodri\VotingApp\Features\VotingSection\External\Factories
 * @author Rodrigo Andrade
 */
class VotingSectionUseCaseFactory implements IVotingSectionUseCaseFactory
{

    #[Pure] public static function createVotingSectionUseCase(Connection $connection, string $schema = 'voting.'): ICreateVotingSectionUseCase
    {
        return (new CreateVotingSectionUseCaseFacade())->createUseCase($connection, $schema);
    }

    public static function deleteVotingSectionUseCase(Connection $connection, string $schema = 'voting.'): IDeleteVotingSectionUseCase
    {
        return (new DeleteVotingSectionUseCaseFacade())->createUseCase($connection, $schema);
    }
}
