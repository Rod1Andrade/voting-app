<?php


namespace Rodri\VotingApp\Features\VotingSection\External\Factories;


use JetBrains\PhpStorm\Pure;

use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingOptionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ICreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowAllVotingSectionsUseCase;
use Rodri\VotingApp\Features\VotingSection\External\Facades\ShowVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IUpdateVotingOptionTitleUseCase;
use Rodri\VotingApp\Features\VotingSection\External\Facades\DeleteVotingOptionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\CreateVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\DeleteVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\ShowAllVotingSectionUseCaseFacade;
use Rodri\VotingApp\Features\VotingSection\External\Facades\UpdateVotingOptionTitleUseCaseFacade;

/**
 * Class VotingSectionUseCaseFactory
 * @author Rodrigo Andrade
 */
class VotingSectionUseCaseFactory implements IVotingSectionUseCaseFactory
{

    #[Pure] public static function createVotingSectionUseCase(string $schema = 'voting.'): ICreateVotingSectionUseCase
    {
        return (new CreateVotingSectionUseCaseFacade())->createUseCase($schema);
    }

    public static function deleteVotingSectionUseCase(string $schema = 'voting.'): IDeleteVotingSectionUseCase
    {
        return (new DeleteVotingSectionUseCaseFacade())->createUseCase($schema);
    }

    #[Pure] public static function showAllVotingSectionUseCase(string $schema = 'voting.'): IShowAllVotingSectionsUseCase
    {
        return (new ShowAllVotingSectionUseCaseFacade())->createUseCase($schema);
    }

    #[Pure] public static function showVotingSectionUseCase(string $schema = 'voting.'): IShowVotingSectionUseCase
    {
        return (new ShowVotingSectionUseCaseFacade())->createUseCase($schema);
    }

    public static function deleteVotingOptionUseCase(string $schema = 'voting.'): IDeleteVotingOptionUseCase
    {
        return (new DeleteVotingOptionUseCaseFacade())->createUseCase($schema);
    }

    public static function updateVotingOptionTitleUseCase(string $schema = 'voting.'): IUpdateVotingOptionTitleUseCase
    {
        return (new UpdateVotingOptionTitleUseCaseFacade())->createUseCase($schema);
    }
}
