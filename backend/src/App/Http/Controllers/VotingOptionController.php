<?php

namespace Rodri\VotingApp\App\Http\Controllers;

use Exception;
use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Database\Connection\PgConnection;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;

/**
 * Controller - VotingOptionController
 * @author Rodrigo Andrade
 */
class VotingOptionController
{
    /**
     * Delete a voting option by VotingOptionUUid
     *
     * @param Request $request
     * @return Response
     */
    public function deleteVotingOption(Request $request): Response
    {
        if(empty($request->param(':votingOptionUuid'))) {
            return new Response(['message' => 'the voting option uuid is necessary'], StatusCode::BAD_REQUEST);
        }

        # Delete Voting Option Factory
        $deleteVotingOptionUseCase = VotingSectionUseCaseFactory::DeleteVotingOptionUseCase(PgConnection::getConnection());

        try {
            $deleteVotingOptionUseCase(
                new VotingOptionUuid($request->param(':votingOptionUuid')),
                new UserUuid($request->getValue('userUuid'))
            );
            return new Response();
        } catch (Exception $e) {
            return new Response(['message' => $e->getMessage()], StatusCode::BAD_REQUEST);
        }
    }

}
