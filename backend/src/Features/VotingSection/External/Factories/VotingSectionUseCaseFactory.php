<?php


namespace Rodri\VotingApp\Features\VotingSection\External\Factories;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ICreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowAllVotingSectionsUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\External\Facades\CreateVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\DeleteVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\ShowAllVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\ShowVotingSectionUseCaseFacade;

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

    #[Pure] public static function showAllVotingSectionUseCase(Connection $connection, string $schema = 'voting.'): IShowAllVotingSectionsUseCase
    {
        return (new ShowAllVotingSectionUseCaseFacade())->createUseCase($connection, $schema);
    }

    public static function showVotingSectionUseCase(Connection $connection, string $schema = 'voting.'): IShowVotingSectionUseCase
    {
        return (new ShowVotingSectionUseCaseFacade())->createUseCase($connection, $schema);
    }
}
