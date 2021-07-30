<?php


namespace Rodri\VotingApp\App\Http\Controllers;


use Exception;
use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Database\Connection\MemorySqliteConnection;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;
use RuntimeException;

/**
 * Class VotingSectionController
 * @package Rodri\VotingApp\App\Http\Controllers
 * @author Rodrigo Andrade
 */
class VotingSectionController
{
    /**
     * Create a Voting Section and Store it.
     * @param Request $request
     * @return Response
     */
    public function createVotingSection(Request $request): Response
    {

        # Body DTO conversion
        $votingDTO = VotingDTO::createVotingDTOfromStdClass(json_decode($request->body()));

        # Use case factory
        $createVotingUseCase = VotingSectionUseCaseFactory::createVotingSectionUseCase(MemorySqliteConnection::getConnection());

        try {
            $createVotingUseCase(VotingDTO::createVotingFromVotingDTO($votingDTO));
        } catch (RuntimeException | Exception $e) {
            return new Response([$e->getMessage()], StatusCode::BAD_REQUEST);
        }

        return new Response();
    }
}