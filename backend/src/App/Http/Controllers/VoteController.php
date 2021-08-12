<?php

namespace Rodri\VotingApp\App\Http\Controllers;

use Exception;
use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Database\Connection\PgConnection;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\External\Factories\VoteUseCaseFactory;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;

/**
 * Controller - VoteController
 * @author Rodrigo Andrade
 */
class VoteController
{
    /**
     * Compute a user vote
     *
     * @param Request $request
     * @return Response
     */
    public function userVote(Request $request): Response
    {
        # Factory User Vote Use Case
        $userVoteUseCase = VoteUseCaseFactory::userVoteUseCase(PgConnection::getConnection());

        try {
            $userVoteUseCase(
                new UserUuid($request->getValue('userUuid')),
                new VotingUuid($request->param(':votingUuid')),
                new VotingOptionUuid($request->input('votingOptionUuid')),
            );

            return new Response(["message" => "Vote registered with success."]);
        } catch (Exception $e) {
            return new Response(['message' => $e->getMessage()], StatusCode::BAD_REQUEST);
        }
    }
}