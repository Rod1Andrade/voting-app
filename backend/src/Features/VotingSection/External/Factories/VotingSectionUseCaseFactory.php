<?php


namespace Rodri\VotingApp\Features\VotingSection\External\Factories;


use JetBrains\PhpStorm\Pure;
use Rodri\VotingApp\App\Database\Connection\Connection;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ICreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingOptionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowAllVotingSectionsUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IUpdateVotingOptionTitleUseCase;
use Rodri\VotingApp\Features\VotingSection\External\Facades\CreateVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\DeleteVotingOptionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\DeleteVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\ShowAllVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\ShowVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\UpdateVotingOptionTitleUseCaseFacade;

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

    public static function DeleteVotingOptionUseCase(Connection $connection, string $schema = 'voting.'): IDeleteVotingOptionUseCase
    {
        return (new DeleteVotingOptionUseCaseFacade())->createUseCase($connection, $schema);
    }

    public static function updateVotingOptionTitleUseCase(Connection $connection, string $schema = 'voting.'): IUpdateVotingOptionTitleUseCase
    {
        return (new UpdateVotingOptionTitleUseCaseFacade())->createUseCase($connection, $schema);
    }
}
