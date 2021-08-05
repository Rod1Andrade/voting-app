<?php

namespace Rodri\VotingApp\App\Http\Controllers;

use Exception;
use InvalidArgumentException;
use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Database\Connection\PgConnection;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
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
        if (empty($request->param(':votingOptionUuid'))) {
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
        } catch (InvalidArgumentException | Exception $e) {
            return new Response(['message' => $e->getMessage()], StatusCode::BAD_REQUEST);
        }
    }

    /**
     * Update Voting Option Title by voting Option Uuid
     *
     * @param Request $request
     * @return Response
     */
    public function updateVotingOptionTitle(Request $request): Response
    {
        # Superficial Bound Data Validation
        if (!$this->boundUpdateVotingOptionTitleValidation($request)) {
            return new Response([
                'message' => 'Check if you send the new title with title body json and check if you send the voting option uuid'
            ], StatusCode::NOT_ACCEPTABLE);
        }

        # Update Voting Option Title Use Case
        $updateVotingOptionTitleUseCase = VotingSectionUseCaseFactory::updateVotingOptionTitleUseCase(PgConnection::getConnection());

        try {
            $updateVotingOptionTitleUseCase(
                title: new Title($request->input('title')),
                votingOptionUuid: new VotingOptionUuid($request->param(':votingOptionUuid')),
                userUuid: new UserUuid($request->getValue('userUuid'))
            );

            return new Response();
        } catch (Exception $e) {
            return new Response(['message' => $e->getMessage()], StatusCode::BAD_REQUEST);
        }
    }

    /**
     * Bound Validation of required values.
     * @param Request $request
     * @return bool TRUE if is valid and False otherwise.
     */
    private function boundUpdateVotingOptionTitleValidation(Request $request): bool
    {
        return !empty($request->input('title')) && !empty($request->param(':votingOptionUuid'));
    }

}
