<?php


namespace Rodri\VotingApp\Features\VotingSection\External\Factories;


use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\ICreateVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingOptionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IDeleteVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowAllVotingSectionsUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IShowVotingSectionUseCase;
use Rodri\VotingApp\Features\VotingSection\Domain\UseCases\IUpdateVotingOptionTitleUseCase;

/**
 *  Factory - Voting section feature
 * @author Rodrigo Andrad
 */
interface IVotingSectionUseCaseFactory
{
    /**
     * @param string $schema
     * @return ICreateVotingSectionUseCase
     */
    public static function createVotingSectionUseCase(string $schema = 'voting.'): ICreateVotingSectionUseCase;

    /**
     * @param string $schema
     * @return IDeleteVotingSectionUseCase
     */
    public static function deleteVotingSectionUseCase(string $schema = 'voting.'): IDeleteVotingSectionUseCase;

    /**
     * @param string $schema
     * @return IShowAllVotingSectionsUseCase
     */
    public static function showAllVotingSectionUseCase(string $schema = 'voting.'): IShowAllVotingSectionsUseCase;

    /**
     * @param string $schema
     * @return IShowVotingSectionUseCase
     */
    public static function showVotingSectionUseCase(string $schema = 'voting.'): IShowVotingSectionUseCase;

    /**
     * @param string $schema
     * @return IDeleteVotingOptionUseCase
     */
    public static function deleteVotingOptionUseCase(string $schema = 'voting.'): IDeleteVotingOptionUseCase;

    /**
     * @param string $schema
     * @return IUpdateVotingOptionTitleUseCase
     */
    public static function updateVotingOptionTitleUseCase(string $schema = 'voting.'): IUpdateVotingOptionTitleUseCase;

}
